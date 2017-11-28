<?php

class modelFeedback extends cmsModel {
    
    /*{comgen-model-methods}*/

/* Handlings */

    public function addHandling($handling){
        return $this->insert('feedback_handlings', $handling);
    }

    public function updateHandling($id, $handling){
        return $this->update('feedback_handlings', $id, $handling);
    }

    public function deleteHandling($id){
        return $this->delete('feedback_handlings', $id);
    }

    public function getHandling($id){
        return $this->getItemById('feedback_handlings', $id);
    }

    public function getHandlingsCount(){
        return $this->getCount('feedback_handlings');
    }

    public function getHandlings(){
        return $this->get('feedback_handlings');
    }

    public function reorderHandlings($ids_list){
        $this->reorderByList('feedback_handlings', $ids_list);
        return true;
    }

    
}
