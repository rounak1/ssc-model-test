<?php
/**
 * Email service
 */

class EmailService
{
    private $apiKey,
        $payload;
    /**
     * send mail
     * @param  [type] $data [description]
     * @return [type]       [description]
     */
    public function send($data, $apiKey = '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')
    {
        $this->apiKey = $apiKey;
        $this->payload($data);
        $this->curl();
    }

    private function payload($data)
    {
        $dataPayload = [];

        if (isset($data['toName'])) {
            $dataPayload = array_merge($dataPayload, ['toname' => $data['toName']]);
        }
        if (isset($data['to'])) {
            $dataPayload = array_merge($dataPayload, ['to' => $data['to']]);
        }
        if (isset($data['fromName'])) {
            $dataPayload = array_merge($dataPayload, ['fromname' => $data['fromName']]);
        }
        if (isset($data['from'])) {
            $dataPayload = array_merge($dataPayload, ['from' => $data['from']]);
        }
        if (isset($data['subject'])) {
            $dataPayload = array_merge($dataPayload, ['subject' => $data['subject']]);
        }
        if (isset($data['message'])) {
            $dataPayload = array_merge($dataPayload, ['text' => $data['message']]);
        }
        if (isset($data['html'])) {
            $dataPayload = array_merge($dataPayload, ['html' => $data['html']]);
        }

        $this->payload = $dataPayload;

    }

    private function url()
    {
        return 'https://api.sendgrid.com/api/mail.send.json';
    }

    private function curl()
    {
        // Generate curl request
        $session = curl_init($this->url());
        // Tell PHP not to use SSLv3 (instead opting for TLS)
        curl_setopt($session, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($session, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $this->apiKey));
        // Tell curl to use HTTP POST
        curl_setopt($session, CURLOPT_POST, true);
        // Tell curl that this is the body of the POST
        curl_setopt($session, CURLOPT_POSTFIELDS, $this->payload);
        // Tell curl not to return headers, but do return the response
        curl_setopt($session, CURLOPT_HEADER, false);
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

        // obtain response
        $response = curl_exec($session);
        // print_r($response);
        curl_close($session);
    }

}
