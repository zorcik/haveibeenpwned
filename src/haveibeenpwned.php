<?php
/**
 * @package weblogic/haveibeenpwned
 */
namespace WebLogic\haveibeenpwned;

use GuzzleHttp\Client;

class haveibeenpwned {

    public function checkPassword($password) {
        $hash = strtoupper(sha1($password));
        $prefix = substr($hash, 0, 5);
        $suffix = substr($hash, 5);

        $url = "https://api.pwnedpasswords.com/range/" . $prefix;
        try {
            $client = new Client();
            $res = $client->request('GET', $url, [
            'headers' => [
                'User-Agent' => 'weblogic/haveibeenpwned'
            ],
            'http_errors' => false,
            ]);
            $response = $res->getBody()->getContents();
        } catch (\Throwable $e) {
            $response = '';
        }

        $lines = explode("\n", $response);

        foreach ($lines as $line) {
            list($hashSuffix, $count) = explode(":", trim($line));
            if ($hashSuffix === $suffix) {
                return (int)$count;
            }
        }

        return 0;
    }
}