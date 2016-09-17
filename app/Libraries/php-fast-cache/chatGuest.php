<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("autoload.php");
class chatGuest
{
    private $cache;

    public function __construct(){
        $this->cache = phpFastCache();
    }

    private function onlineGuests($email){
        $onlineGuests = $this->cache->get("onlineGuests");

        if(is_null($onlineGuests)){
            $onlineGuests = array($email);
            $this->cache->set("onlineGuests", $onlineGuests, 0);
        }else{
            $exists = in_array($email, $onlineGuests);
            if($exists !== false) {
                $onlineGuests[sizeof($onlineGuests)] = $email;
                $this->cache->set("onlineGuests", $onlineGuests, 0);
            }
        }

        $this->cache->set("#$email--timer", 1, 120);
    }

    public function keepLive($email){
        $this->cache->set("#$email--timer", $this->cache->get("#$email--timer"), 10);
        $this->cache->set("#$email--status", $this->cache->get("#$email--status"), 10);
        $this->cache->set("#$email--messageTime", $this->cache->get("#$email--messageTime"), 10);
        $this->cache->set("#$email--messages", $this->cache->get("#$email--messages"), 10);
        $this->cache->set("#$email--count", $this->cache->get("#$email--count"), 10);
        $this->cache->set("#$email--empID", $this->cache->get("#$email--empID"), 10);
    }

    public function messaged($email, $chatMessage){

        if(!$this->cache->isExisting("#$email--timer")) {
            $this->onlineGuests($email);
        }

        $messages = $this->cache->get("#$email--messages");
        $messageTime = $this->cache->get("#$email--messageTime");
        if(is_null($messages)){
            $messages = array("$chatMessage##?#*#guest");
            $messageTime = array(date('h:i:s') . "##?#*#guest");
            $this->cache->set("#$email--count", 1, 1200);
            $this->cache->set("#$email--messages", $messages, 1200);
            $this->cache->set("#$email--messageTime", $messageTime, 1200);
        }else{
            $messages[sizeof($messages)] = "$chatMessage##?#*#guest";
            $messageTime[sizeof($messageTime)] = date('h:i:s') . "##?#*#guest";
            $this->cache->increment("#$email--count", $step = 1);
            $this->cache->set("#$email--messages", $messages, 1200);
            $this->cache->set("#$email--messageTime", $messageTime, 1200);
        }

        $status = "Messaged";
        $this->cache->set("#$email--status", $status, 120);
        return $this->cache->get("#$email--count");
    }

    public function checkReplied($email){
        return $this->cache->get("#$email--status");
    }

    public function getMessageCount($email){
        return $this->cache->get("#$email--count");
    }

    public function getMessages($email){
        return $this->cache->get("#$email--messages");
    }

    public function getTimes($email){
        return $this->cache->get("#$email--messageTime");
    }

    public function getEmp($email){
        return $this->cache->get("#$email--empID");
    }

    public function onlineEmployees(){
        return $this->cache->get("onlineEmployees");
    }

    public function empGuestCount($id){
        return sizeof($this->cache->get("#$id--guests"));
    }

    public function goingOffline($email, $id)
    {
        $onlineGuests = $this->cache->get("onlineGuests");
        array_splice($onlineGuests, $email, 1);
        $this->cache->set("onlineGuests", $onlineGuests, 0);

        $empGuests = $this->cache->get("#$id--guests");
        array_splice($empGuests, $guestEmail, 1);
        $this->cache->set("#$id--guests", $empGuests, 1200);

        $this->cache->delete("#$email--timer");
        $this->cache->delete("#$email--status");
        $this->cache->delete("#$email--messageTime");
        $this->cache->delete("#$email--messages");
        $this->cache->delete("#$email--count");
        $this->cache->delete("#$email--empID");
    }

    public function checkEmpIsOnline($id){
        if(!$this->cache->isExisting("#$id--EmpTimer")){
            if(!is_null($this->cache->get("onlineEmployees"))) {
                $onlineEmp = $this->cache->get("onlineEmployees");

                $exists = in_array($id, $onlineEmp);
                if($exists !== true) {
                    array_splice($onlineEmp, $id, 1);
                    $this->cache->set("onlineEmployees", $onlineEmp, 0);
                }
            }
            return false;
        }else{
            return true;
        }
    }

    public function setEmp($id, $email){
        $empGuests = $this->cache->get("#$id--guests");

        if(is_null($empGuests)){
            $empGuests = array($email);
            $this->cache->set("#$id--guests", $empGuests, 120);
        }else{
            $empGuests[sizeof($empGuests)] = $email;
            $this->cache->set("#$id--guests", $empGuests, 120);
        }
        $this->cache->set("#$email--empID", $id, 120);
    }

    public function clearAll(){
        $this->cache->clean();
    }
}