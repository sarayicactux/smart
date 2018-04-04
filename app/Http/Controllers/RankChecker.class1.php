<?php
use App\Models\rank;
if (@ini_set('max_execution_time', 10800) !== false) {
    @ini_set('max_execution_time', 10800);
}

if (!class_exists('GoogleRankChecker')) {
    class GoogleRankChecker
    {
        public $start;
        public $end;

        public function __construct($start = 1, $end = 2)
        {
            $this->start = $start;
            $this->end = $end;
        }

        public function find($keyword, $useproxie, $proxies)
        {

            $results = [];
            $wordS = $keyword;

            $ua =  'Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201';


            $options = [
                'http' => [
                    'method' => 'GET',
                    'header' => "Accept-language: en\r\n" .
                        "Cookie: PHP Google Keyword Position\r\n" .
                        "User-Agent: " . $ua
                ]
            ];


            $arrayproxies       = [];


            $keyword    = str_replace(' ', '+', trim($keyword));
            $url        = sprintf('https://www.google.com/search?ie=UTF-8&q=%s&start=%s&num=30', $keyword, 0);

            $context    = stream_context_create($options);

            $data  = $this->_curl($url, $useproxie, $arrayproxies);

            if (is_array($data)) {
                $errmsg    = $data['errmsg'];
                $results   = ['rank' => 'zero', 'url' => $errmsg];
            } else {

                $j = -1;
                $i = 1;

                while (($j = stripos($data, '<cite class="_Rm">', $j+1)) !== false) {
                    $k           = stripos($data, '</cite>', $j);
                    $link        = strip_tags(substr($data, $j, $k-$j));
                    $rank        = $i++;
                    //$results[]   = ['rank' => $rank, 'url' => $link];
                    $grank = New rank();
                    $grank->keyword = $wordS;
                    $grank->rank = $rank;
                    $grank->url = $link;
                    $grank->save();
                }
                if (!(isset($grank))){

                    $startpos = strpos($data, 'data-sitekey="');
                    $sitekey  = substr($data,$startpos+14,40);
                    include("anticaptcha/anticaptcha.php");
                    include("anticaptcha/nocaptchaproxyless.php");
                    $api = new NoCaptchaProxyless();
                    $api->setVerboseMode(true);

//your anti-captcha.com account key
                    $api->setKey("2dd92cf4290d12ef110f6354d8a1d71b");

//recaptcha key from target website
                    $api->setWebsiteURL($url);
                    $api->setWebsiteKey("6Lc_aCMTAAAAABx7u2W0WPXnVbI_v6ZdbM6rYf16");

                    if (!$api->createTask()) {
                        $api->debout("API v2 send failed - ".$api->getErrorMessage(), "red");
                        return false;
                    }

                    $taskId = $api->getTaskId();

                    if (!$api->waitForResult()) {
                        $api->debout("could not solve captcha", "red");
                        $api->debout($api->getErrorMessage());
                    } else {
                        $recaptchaToken =   $api->getTaskSolution();
                        $url        = sprintf("https://www.google.com/search?ie=UTF-8&g-recaptcha-response=$recaptchaToken&q=%s&start=%s&num=30", $keyword, 0);

                        $context    = stream_context_create($options);

                        $data  = $this->_curl($url, $useproxie, $arrayproxies);
                        if (is_array($data)) {
                            $errmsg    = $data['errmsg'];
                            $results   = ['rank' => 'zero', 'url' => $errmsg];
                        } else {

                            $j = -1;
                            $i = 1;

                            while (($j = stripos($data, '<cite class="_Rm">', $j + 1)) !== false) {
                                $k = stripos($data, '</cite>', $j);
                                $link = strip_tags(substr($data, $j, $k - $j));
                                $rank = $i++;
                                //$results[]   = ['rank' => $rank, 'url' => $link];
                                $grank = New rank();
                                $grank->keyword = $wordS;
                                $grank->rank = $rank;
                                $grank->url = $link;
                                $grank->save();
                            }
                        }

                    }

                }


            }





            // return $results;
        }

        private function _isCurlEnabled()
        {
            return function_exists('curl_version');
        }

        private function _curl($url, $useproxie, $arrayproxies)
        {
            try {
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246');
                curl_setopt($ch, CURLOPT_AUTOREFERER, true);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
                curl_setopt($ch, CURLOPT_TIMEOUT, 120);
                curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSLVERSION, 'all');

                if ($useproxie) {
                    if (!empty($arrayproxies)) {
                        foreach($arrayproxies as $param => $val) {
                            curl_setopt($ch, $param, $val);
                        }
                    }
                }

                $content = curl_exec($ch);
                $errno   = curl_errno($ch);
                $error   = curl_error($ch);
                curl_close($ch);

                if (!$errno) {
                    return $content;
                } else {
                    return [
                        'errno' => $errno,
                        'errmsg'=> $error
                    ];
                }
            } catch (Exception $e) {
                return [
                    'errno'     => $e->getCode(),
                    'errmsg'    => $e->getMessage()
                ];
            }
        }
    }
}