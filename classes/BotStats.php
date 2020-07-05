<?php

class BotStats extends Action
{
    protected $_table = "bot_stats";

    public function get($where = ['id', '=', '1'], $fields = '*'){
        $data = parent::get($where, $fields);
        $botStat = null;
        if(count($data) <= 0) {
            $botStat = $this->createBotStat();
        }else{
            $botStat = $data[0];
        }
        return $botStat;
    }

    public function incrementContacted() {
        $botStat = $this->get();
        if(!isset($botStat)) {
            $botStat = $this->createBotStat();
        }
        $contacted = $botStat->contacted;
        $botStat->contacted = $contacted + 1;
        $this->update($botStat->id, (array)$botStat);
        return $botStat;
    }

    public function incrementChatStarted() {
        $botStat = $this->get();
        if(!isset($botStat)) {
            $botStat = $this->createBotStat();
        }
        $chat_started = $botStat->chat_started;
        $botStat->chat_started = $chat_started + 1;
        $this->update($botStat->id, (array)$botStat);
        return $botStat;
    }

    public function incrementChatInterrupted() {
        $botStat = $this->get();
        if(!isset($botStat)) {
            $botStat = $this->createBotStat();
        }
        $chat_interrupted = $botStat->chat_interrupted;
        $botStat->chat_interrupted = $chat_interrupted + 1;
        $this->update($botStat->id, (array)$botStat);
        return $botStat;
    }

    public function incrementSupportTickets() {
        $botStat = $this->get();
        if(!isset($botStat)) {
            $botStat = $this->createBotStat();
        }
        $support_tickets = $botStat->support_tickets;
        $botStat->support_tickets = $support_tickets + 1;
        $this->update($botStat->id, (array)$botStat);
        return $botStat;
    }

    private function createBotStat(){
        $data = ["id"=> 1, "contacted"=>0, "chat_started"=>0, "chat_interrupted"=>0, "support_tickets"=>0];
        $this->create($data);
        return $data;
    }

}