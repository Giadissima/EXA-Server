<?php

  class Response {
    private $message;
    private $status;
    private $data;

    public function Response($message, $status, $data=[]) {
      header("Content-Type: application/json");
      $this->message = $message;
      $this->status = $status;
      $this->data = $data; 
    }

    public function __toString() {
      $response = [
        "message"=>$this->message,
        "status"=> $this->status,
      ];

      if (count($this->data) > 0)
        $response["data"] =  $this->data;
      
      return json_encode($response, JSON_PRETTY_PRINT);
    }
  }

?>