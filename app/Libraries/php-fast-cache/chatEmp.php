<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once("autoload.php");
class chatEmp
{
    private $cache;

    public function __construct(){
        $this->cache = phpFastCache();
    }

    public function onlineEmployees($id){
        $onlineEmployees = $this->cache->get("onlineEmployees");

        if(is_null($onlineEmployees)){
            $onlineEmployees = array($id);
            $this->cache->set("onlineEmployees", $onlineEmployees, 0);
        }else{
            $exists = in_array($id, $onlineEmployees);
            if($exists !== true) {
                $onlineEmployees[sizeof($onlineEmployees)] = $id;
                $this->cache->set("onlineEmployees", $onlineEmployees, 0);
            }
        }

        $this->cache->set("#$id--EmpTimer", 1, 15);
        return $this->cache->get("onlineEmployees");
    }

    public function empKeepLive($id){
        $this->cache->set("#$id--EmpTimer", $this->cache->set("#$id--EmpTimer"), 5);
        $this->cache->set("#$id--guests", $this->cache->get("#$id--guests"), 5);
    }

    public function empMessaged($guestEmail, $replyMessage){
        $messages = $this->cache->get("#$guestEmail--messages");
        $messageTime = $this->cache->get("#$guestEmail--messageTime");
        if(is_null($messages)){
            $messages = array("$replyMessage##?#*#emp");
            $messageTime = array(date('h:i:s') . "##?#*#emp");
            $this->cache->set("#$guestEmail--count", 1, 1200);
            $this->cache->set("#$guestEmail--messages", $messages, 1200);
            $this->cache->set("#$guestEmail--messageTime", $messageTime, 1200);
        }else{
            $messages[sizeof($messages)] = "$replyMessage##?#*#emp";
            $messageTime[sizeof($messageTime)] = date('h:i:s') . "##?#*#emp";
            $this->cache->increment("#$guestEmail--count", $step = 1);
            $this->cache->set("#$guestEmail--messages", $messages, 1200);
            $this->cache->set("#$guestEmail--messageTime", $messageTime, 1200);
        }

        $this->cache->set("#$guestEmail--status", "Replied", 1200);
    }

    public function checkGuestIsOnline($guestEmail){
        if($this->cache->isExisting("#$guestEmail--timer")){
            return true;
        }else{
            return false;
        }
    }

    public function checkEmpIsOnline($id){
        if(!$this->cache->isExisting("#$id--EmpTimer")){
            $onlineEmp = $this->cache->get("onlineEmployees");
            array_splice($onlineEmp, $id, 1);
            $this->cache->set("onlineEmployees", $onlineEmp, 0);
        }
    }

    public function checkMessaged($guestEmail){
        $a = array($this->cache->get("#$guestEmail--status"));
        if(implode("", $a) == ""){
            return null;
        }else{
            return $this->cache->get("#$guestEmail--status");
        }
    }

    public function getMessageCount($guestEmail){
        if(is_null($this->cache->get("#$guestEmail--count"))){
            return null;
        }else {
            return $this->cache->get("#$guestEmail--count");
        }
    }

    public function getMessages($guestEmail){
        if(is_null($this->cache->get("#$guestEmail--messages"))){
            return null;
        }else{
            return $this->cache->get("#$guestEmail--messages");
        }
    }

    public function getTimes($guestEmail){
        if(is_null($this->cache->get("#$guestEmail--messageTime"))){
            return null;
        }else {
            return $this->cache->get("#$guestEmail--messageTime");
        }
    }

    public function getGuests($id){
        if(is_null($this->cache->get("#$id--guests"))){
            return null;
        }else {
            return $this->cache->get("#$id--guests");
        }
    }

    public function makeGuestOffline($guestEmail, $id)
    {
        $onlineGuests = $this->cache->get("onlineGuests");
        array_splice($onlineGuests, $guestEmail, 1);
        $this->cache->set("onlineGuests", $onlineGuests, 0);

        $empGuests = $this->cache->get("#$id--guests");
        array_splice($empGuests, $guestEmail, 1);
        $this->cache->set("#$id--guests", $empGuests, 1200);

        $this->cache->delete("#$guestEmail--status");
        $this->cache->delete("#$guestEmail--messageTime");
        $this->cache->delete("#$guestEmail--messages");
        $this->cache->delete("#$guestEmail--count");
        $this->cache->delete("#$guestEmail--empID");
    }

    public function empGoOffline($id){
        $onlineEmp = $this->cache->get("onlineEmployees");
        array_splice($onlineEmp, $id, 1);
        $this->cache->set("onlineEmployees", $onlineEmp, 0);
        $this->cache->delete("#$id--EmpTimer");
        $this->cache->delete("#$id--guests");
    }

    public function nikan(){
      //  return $this->cache->get("#$5--guests");
      //  return $this->cache->get("#aaa@aaa.aaa--status");
        return $this->cache->clean();
      //  return $this->cache->stats();
    }
}