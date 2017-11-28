var icms = icms || {};

icms.datagrid = (function ($) {

	this.options = {};
    this.selected_rows = [];
    this.is_loading = true;
    this.callback = false;
	this.was_init = false;

    //====================================================================//

    this.setOptions = function(options){
        this.options = options;
    }

    //====================================================================//

    this.bind_sortable = function(){
        $('.datagrid th.sortable').click(function(){
			console.log('click');
            icms.datagrid.clickHeader($(this).attr('rel'));
        });
    };
    this.bind_filter = function(){
        $('.datagrid .filter .input, .datagrid .filter .date-input, .datagrid .filter select').on('input change', function () {
            $('.datagrid .filter .input, .datagrid .filter .date-input, .datagrid .filter select').each(function(){
                var filter = $(this).attr('rel');
                $('#datagrid_filter input[name='+filter+']').val($(this).val());
            });
            icms.datagrid.setPage(1);
            icms.datagrid.loadRows();
        });
        $('.datagrid .filter .date-input').each(function(){
            icms.events.on('icms_datepicker_selected_'+$(this).attr('id'), function(inst){
                $('#'+$(inst).attr('id')).trigger('input');
            });
        });
    };

    //====================================================================//

    this.init = function(){

        if(this.was_init){return false;}
        this.was_init = true;

        console.log('init');

        if (this.options.is_sortable){
            console.log('sortable');
			this.bind_sortable();
        } else {
            console.log('not sortable');
        }

        if (this.options.is_filter){
            this.bind_filter();
        }

        if (this.options.is_pagination){
            $('.datagrid_resize select').change(function(){
                icms.datagrid.setPage(1, $(this).val());
                icms.datagrid.loadRows();
            });
        }

        if (this.options.is_selectable){
            var shift = false;
            var tbody = $('#datagrid > tbody');
            var last = tbody.find('> tr:not(.filter):first');
            $(document).keydown(function(event){
                if(event.keyCode === 16){
                    shift = true;
                    try{$('#datagrid').disableSelection();}catch(e){}
                }
            }).keyup(function(event){
                if(event.keyCode === 16){
                    shift = false;
                    try{$('#datagrid').enableSelection();}catch(e){}
                }
            });
            var checkSelectedCount = function (){
                $('.datagrid_select_actions .shint, .datagrid_select_actions .sall').show();
                var _total  = +$('#datagrid > tbody > tr:not(.filter)').length;
                var _totals = +$('#datagrid > tbody > tr:not(.filter).selected').length;
                if(_totals > 0){
                    $('.datagrid_select_actions .sremove, .datagrid_select_actions .sinvert').show();
                } else {
                    $('.datagrid_select_actions .sremove, .datagrid_select_actions .sinvert').hide();
                }
                if(_total === _totals){
                    $('.datagrid_select_actions .shint, .datagrid_select_actions .sall, .datagrid_select_actions .sinvert').hide();
                }
            };
            $(document).on('click', '#datagrid > tbody > tr:not(.filter) > td', function(){
                var tr = $(this).parent();
                if(shift){
                    if(!last.size()){last = tbody.find('> tr:not(.filter):first').toggleClass('selected');}
                    var in1 = tbody.find('> tr:not(.filter)#'+tr.attr('id')).index();
                    var in2 = tbody.find('> tr:not(.filter)#'+last.attr('id')).index();
                    if(in1 === in2){
                        tr.toggleClass('selected');
                    }else{
                        tbody.find('> tr:not(.filter)').slice((in1<in2 ? in1-1 : in2), (in1<in2 ? in2-1 : in1)).toggleClass('selected');
                    }
                }else{
                    tr.toggleClass('selected');
                }
                last = tr;
                checkSelectedCount();
            });
            $('.datagrid_select_actions .shint, .datagrid_select_actions .sall').show();
            $('.datagrid_select_actions .sall').on('click', function (){
                $('#datagrid > tbody > tr:not(.filter)').addClass('selected'); checkSelectedCount();
            });
            $('.datagrid_select_actions .sremove').on('click', function (){
                $('#datagrid > tbody > tr:not(.filter)').removeClass('selected'); checkSelectedCount();
            });
            $('.datagrid_select_actions .sinvert').on('click', function (){
                $('#datagrid > tbody > tr:not(.filter) > td').trigger('click');
            });
        }

        this.setOrdering();

        if (this.options.url){
            this.loadRows();
        }

        var sb = $('#datatree').parent();
        $(sb).after('<td id="slide_cell"></td>');
        $('#slide_cell').on('click', function (){
            if($(sb).is(':visible')){
                $(sb).hide();
                $(this).addClass('unslided');
            } else {
                $(sb).show();
                $(this).removeClass('unslided');
            }
        });
        $(window).on('resize', function(){
            if(!$(sb).is(':visible')){
                $('#slide_cell').addClass('unslided');
            }
        }).triggerHandler('resize');
        $(document).on('click', '.inline_submit', function(){
            var s_button = $(this);
            $(s_button).prop('disabled', true).parent().addClass('process_save');
            var tr_wrap = $(this).closest('tr');
            var action_url = $(this).data('action');
            var fields = {};
            $(tr_wrap).find('.grid_field_edit input.input').each(function (){
                fields[$(this).attr('name')] = $(this).val();
            });
            $.post(action_url, {data: fields}, function(data){
                $(s_button).prop('disabled', false).parent().removeClass('process_save');
                if(data.error){ icms.modal.alert(data.error); } else {
                    $(tr_wrap).find('.grid_field_edit').addClass('success').removeClass('edit_by_click_visible');
                    $(tr_wrap).find('.grid_field_value').removeClass('edit_by_click_hidden');
                    for(var _field in fields){
                        var g_value_wrap = $(tr_wrap).find('.'+_field+'_grid_value');
                        if($(g_value_wrap).children().length){
                            $(g_value_wrap).find('*').last().html(data.values[_field]);
                        } else {
                            $(g_value_wrap).html(data.values[_field]);
                        }
                    }
                }
            }, 'json');
            return false;
        });
        $(document).on('input', '.grid_field_edit input.input', function(){
            $(this).parent().removeClass('success');
        });
        $(document).on('keypress', '.grid_field_edit input.input', function(e){
            if (e.which == 13) {
                $(this).closest('tr').find('.inline_submit').trigger('click');
            }
        });
        $(document).on('click', '.grid_field_value.edit_by_click', function(event){
            if (event.target.nodeName === 'A') { return true; }
            $(this).addClass('edit_by_click_hidden').parent().find('.grid_field_edit').addClass('edit_by_click_visible').find('input.input').focus();
        });

    }

    //====================================================================//

    this.submit = function(url, confirm_message){

        var selected_rows_count = this.selectedRowsCount();
        if (selected_rows_count == 0  && !this.options.is_draggable) {return false;}

        if (typeof(confirm_message) == 'string'){
            if (!confirm(confirm_message)){return false;}
        }

        if (typeof(url) != 'string') {url = $(url).data('url');}

        $('#datagrid_form').html('');
        $('#datagrid_form').attr('action', url);

        if (selected_rows_count > 0){
            $('.datagrid tbody tr.selected').each(function(){
                var row_id = $(this).attr('id');
                $('#datagrid_form').append('<input type="hidden" name="selected[]" value="'+row_id+'" />');
            })
        }

        if (this.options.is_draggable){
            $('.datagrid tbody tr').each(function(){
                var row_id = $(this).attr('id');
                $('#datagrid_form').append('<input type="hidden" name="items[]" value="'+row_id+'" />');
            })
        }

        $('#datagrid_form').submit();

        return false;

    }

    //====================================================================//

    this.submitAjax = function (url, confirm_message){

        var selected_rows_count = this.selectedRowsCount();
        if (selected_rows_count == 0) {return false;}

        if (typeof(confirm_message) == 'string'){
            if (!confirm(confirm_message)){return false;}
        }

        if (typeof(url) != 'string') {url = $(url).data('url');}

        this.selected_rows = [];
        $('.datagrid tr.selected').each(function(){
            icms.datagrid.selected_rows.push($(this).attr('id'));
        });

        icms.modal.openAjax(url, {selected: this.selected_rows});

        return false;

    }

    //====================================================================//

    this.selectedRowsCount = function(){

        if (!this.options.is_selectable) {return 0;}

        var selected_rows_count = $('.datagrid tr.selected').length;

        if (this.options.is_selectable && !selected_rows_count) {
            icms.modal.alert(LANG_LIST_NONE_SELECTED, 'ui_warning');
            return 0;
        }

        return selected_rows_count;

    }

    //====================================================================//

    this.clickHeader = function(name){

        if (this.options.order_by != name){
            this.options.order_to = 'asc';
        } else {
            this.options.order_to = this.options.order_to == 'desc' ? 'asc' : 'desc';
        }

        this.options.order_by = name;
        this.setOrdering();
        this.loadRows();

    }

    //====================================================================//

    this.setURL = function(url){
        this.options.url = url;
        this.setPage(1);
    }

    this.setOrdering = function(){
        if (!this.options.is_sortable) {return;}

        $('#datagrid_filter input[name=order_by]').val(this.options.order_by);
        $('#datagrid_filter input[name=order_to]').val(this.options.order_to);

        $('.datagrid th').removeClass('sort_asc').removeClass('sort_desc');
        $('.datagrid th[rel='+this.options.order_by+']').addClass('sort_'+this.options.order_to);
    }

    this.setPage = function(page, perpage){
        if (!this.options.is_pagination) {return;}

        this.options.page = page;
        if (typeof(perpage) != 'undefined'){this.options.perpage = perpage;}

        $('#datagrid_filter input[name=page]').val(this.options.page);
        $('#datagrid_filter input[name=perpage]').val(this.options.perpage);
    }

    //====================================================================//

    this.loadRows = function (callback){
		if(!this.was_init){return false;}

        this.is_loading = true;

        this.showLoadIndicator();

        var filter_query = $('#datagrid_filter').serialize();

        var heads = [];
        $('#datagrid thead th[rel]').each(function(){
            heads.push($(this).attr('rel'));
        });

        $.post(this.options.url, {filter: filter_query, heads: heads}, function(result){
            icms.datagrid.rowsLoaded(result);
            if (typeof(callback) != 'undefined'){
                callback();
            }
        }, 'json');

    }

    //====================================================================//

    this.rowsLoaded = function(result){

        icms.datagrid.is_loading = false;

        icms.datagrid.hideLoadIndicator();

        $('.datagrid > tbody > tr:not(.filter)').remove();
        $('.datagrid_pagination').hide();

        if(result.columns.length){
            var htr = $('.datagrid > thead > tr:first');
            var ftr = $('.datagrid > tbody > tr.filter');
            htr.find('> th').remove();
            ftr.find('> td').remove();
            for(var key in result.columns)if(result.columns.hasOwnProperty(key)){
                htr.append('<th width="'+result.columns[key]['width']+'" rel="'+result.columns[key]['name']+'"'+(result.columns[key]['sortable'] ? ' class="sortable"' : '')+'>'+result.columns[key]['title']+'</th>');
                ftr.append('<td>'+(result.columns[key]['filter']||'&nbsp;')+'</td>');

                $('#datagrid_filter input[name="'+result.columns[key]['name']+'"]').remove();
                if(result.columns[key]['filter']){
                    $('#datagrid_filter').append('<input type="hidden" value="'+($(result.columns[key]['filter']).val()||'')+'" name="'+result.columns[key]['name']+'" />');
                }
            }
            icms.datagrid.bind_sortable();
            icms.datagrid.bind_filter();
        }

        if(!result.rows.length){
            var columns_count = $('.datagrid thead th').length;
            $('.datagrid tbody').append('<tr><td colspan="'+columns_count+'"><span class="empty">'+LANG_LIST_EMPTY+'</span></td></tr>');
            if (this.callback) { this.callback(); }
            return;
        }

        $.each(result.rows, function(i){
            var row = this;
            var row_html = '<tr id="'+(row[0] > 0 ? row[0] : ('tr_id_'+i))+'">';
            $.each(row, function(index){
                if (index>0 || icms.datagrid.options.show_id) {
                        row_html = row_html + '<td>' + this + '</td>';
                }
            });
            row_html = row_html + '</tr>';
            $('.datagrid tbody').append(row_html);
        });

        $('.datagrid tbody tr:odd').addClass('odd');

        if (icms.datagrid.options.is_draggable) {
            $('#datagrid').tableDnD({
                onDragClass: 'dragged',
                onDrop: function(table, row) {
                    $('.datagrid tbody tr').removeClass('odd');
                    $('.datagrid tbody tr:odd').addClass('odd');
                }
            });
        }

        if (icms.datagrid.options.is_pagination && result.pages_count > 1) {
            $('.datagrid_pagination').show();
            if (result.pages_count != icms.datagrid.options.pages_count){

                $('.datagrid_pagination').paginate({
                            count 		: result.pages_count,
                            start 		: 1,
                            display     : 7,
                            border					: false,
                            images					: false,
                            rotate                  : false,
                            mouse					: 'press',
                            border_color  			: '#fff',
                            text_color  			: '#333',
                            background_color    	: '#fff',
                            border_hover_color		: '#7d929d',
                            text_hover_color  		: '#fff',
                            background_hover_color	: '#7d929d',
                            onChange     			: function(page){
                                icms.datagrid.setPage(page);
                                icms.datagrid.loadRows();
                            }
                });

            }
        }

        icms.datagrid.options.pages_count = result.pages_count;

		$('.datagrid .flag_trigger > a').on('click', function(){

			var url = $(this).attr('href');
			var link = $(this);

			link.parent('.flag_trigger').addClass('loading');

			$.post(url, {}, function(result){

				var flag = link.parent('.flag_trigger').removeClass('loading');
				if (result.error){ return; }

				var flag_class = flag.data('class');
				var flag_class_on = flag_class + '_on';
				var flag_class_off = flag_class + '_off';

				if (result.is_on){
					flag.removeClass(flag_class_off).addClass(flag_class_on);
				} else {
					flag.removeClass(flag_class_on).addClass(flag_class_off);
				}

			}, 'json');

			return false;

		});

        if (icms.datagrid.callback) { icms.datagrid.callback(); }

        icms.events.run('datagrid_rows_loaded', result);

        icms.modal.bind('a.ajax-modal');

    };

    //====================================================================//

    this.showLoadIndicator = function(){
        if (!this.is_loading) {return;}
        $('.datagrid_loading').show();
    };

    this.hideLoadIndicator = function(){
        $('.datagrid_loading').fadeOut('fast');
    };

	this.escapeHtml = function(text) {
		return text
			.replace(/&/g, "&amp;")
			.replace(/</g, "&lt;")
			.replace(/>/g, "&gt;")
			.replace(/"/g, "&quot;")
			.replace(/'/g, "&#039;");
	}

    //====================================================================//


	return this;

}).call(icms.datagrid || {},jQuery);
