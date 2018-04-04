<?php
if (@ini_set('max_execution_time', 3200) !== false) {
    @ini_set('max_execution_time', 3200);
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


            $ua = [
                0   => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201',
                10  => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
                20  => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1'
            ];

            if ($useproxie) {
                $host      = $proxies['host'];
                $port      = $proxies['port'];
                $username  = $proxies['username'];
                $password  = $proxies['password'];

                if (!empty($username)) {
                    $auth     = base64_encode($username . ':' . $password);
                    $useauth  = sprintf('Proxy-Authorization: Basic %s', $auth);
                } else {
                    $useauth  = '';
                }

                $options = [
                    'http' => [
                        'method' => 'GET',
                        'header' => "Accept-language: en\r\n" .
                            "Cookie: PHP Google Keyword Position\r\n" .
                            "User-Agent: " . $ua[0] . "\r\n".
                            $useauth,
                        'proxy'  => sprintf('tcp://%s:%s', $host, $port),
                        'request_fulluri' => true
                    ]
                ];
            } else {
                $options = [
                    'http' => [
                        'method' => 'GET',
                        'header' => "Accept-language: en\r\n" .
                            "Cookie: PHP Google Keyword Position\r\n" .
                            "User-Agent: " . $ua[0]
                    ]
                ];
            }

            if ($useproxie) {
                if (!empty($username)) {
                    $auth = base64_encode($username . ':' . $password);
                    $arrayproxies   = [
                        CURLOPT_PROXY        => $host,
                        CURLOPT_PROXYPORT    => $port,
                        CURLOPT_PROXYUSERPWD => $auth
                    ];
                } else {
                    $arrayproxies   = [
                        CURLOPT_PROXY        => $host,
                        CURLOPT_PROXYPORT    => $port
                    ];
                }
            } else {
                $arrayproxies       = [];
            }

            $keyword    = str_replace(' ', '+', trim($keyword));
            $url        = sprintf('https://www.google.com/search?ie=UTF-8&q=%s&start=%s&num=30', $keyword, 0);
            $context    = stream_context_create($options);

            if ($this->_isCurlEnabled()) {
                $data  = $this->_curl($url, $useproxie, $arrayproxies);
            } else {
                $data  = @file_get_contents($url, false, $context);
            }

            if (is_array($data)) {
                $errmsg    = $data['errmsg'];
                $results   = ['rank' => 'zero', 'url' => $errmsg];
            } else {
                if (strpos($data, 'To continue, please type the characters below') !== false || $data == false
                    || strpos($data, "We're sorry") !== false ) {
                    $results = ['rank' => 'zero', 'url' => ''];
                } else {
                    $j = -1;
                    $i = 1;

                    while (($j = stripos($data, '<cite class="iUh30">', $j+1)) !== false) {
                        $k           = stripos($data, '</cite>', $j);
                        $link        = strip_tags(substr($data, $j, $k-$j));
                        $rank        = $i++;
                        $results[]   = ['rank' => $rank, 'url' => $link];
                    }
                }
            }


            if (count($results) == 0 ){
                sleep(30);
                $keyword    = str_replace('+', ' ', trim($keyword));
                $this->find($keyword, $useproxie, $proxies);
                //$results = $this->findWithCaptcha($keyword, $useproxie, $proxies,$data,$url);
            }

            return $results;
        }


        private function findWithCaptcha($keyword, $useproxie, $proxies,$data,$url)
        {
            $results = [];
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
            $api->setWebsiteKey($sitekey);

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
                $ua = [
                    0   => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201',
                    10  => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
                    20  => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1'
                ];

                if ($useproxie) {
                    $host      = $proxies['host'];
                    $port      = $proxies['port'];
                    $username  = $proxies['username'];
                    $password  = $proxies['password'];

                    if (!empty($username)) {
                        $auth     = base64_encode($username . ':' . $password);
                        $useauth  = sprintf('Proxy-Authorization: Basic %s', $auth);
                    } else {
                        $useauth  = '';
                    }

                    $options = [
                        'http' => [
                            'method' => 'GET',
                            'header' => "Accept-language: en\r\n" .
                                "Cookie: PHP Google Keyword Position\r\n" .
                                "User-Agent: " . $ua[0] . "\r\n".
                                $useauth,
                            'proxy'  => sprintf('tcp://%s:%s', $host, $port),
                            'request_fulluri' => true
                        ]
                    ];
                } else {
                    $options = [
                        'http' => [
                            'method' => 'GET',
                            'header' => "Accept-language: en\r\n" .
                                "Cookie: PHP Google Keyword Position\r\n" .
                                "User-Agent: " . $ua[0]
                        ]
                    ];
                }

                if ($useproxie) {
                    if (!empty($username)) {
                        $auth = base64_encode($username . ':' . $password);
                        $arrayproxies   = [
                            CURLOPT_PROXY        => $host,
                            CURLOPT_PROXYPORT    => $port,
                            CURLOPT_PROXYUSERPWD => $auth
                        ];
                    } else {
                        $arrayproxies   = [
                            CURLOPT_PROXY        => $host,
                            CURLOPT_PROXYPORT    => $port
                        ];
                    }
                } else {
                    $arrayproxies       = [];
                }

                //$keyword    = str_replace(' ', '+', trim($keyword));

                $context    = stream_context_create($options);

                if ($this->_isCurlEnabled()) {
                    $data  = $this->_curl2( $url,$recaptchaToken,$sitekey);
                } else {
                    $data  = @file_get_contents($url, false, $context);
                }
                return $data;
                if (is_array($data)) {
                    $errmsg    = $data['errmsg'];
                    $results   = ['rank' => 'zero', 'url' => $errmsg];
                } else {
                    if (strpos($data, 'To continue, please type the characters below') !== false || $data == false
                        || strpos($data, "We're sorry") !== false ) {
                        $results = ['rank' => 'zero', 'url' => ''];
                    } else {
                        $j = -1;
                        $i = 1;

                        while (($j = stripos($data, '<cite class="iUh30">', $j+1)) !== false) {
                            $k           = stripos($data, '</cite>', $j);
                            $link        = strip_tags(substr($data, $j, $k-$j));
                            $rank        = $i++;
                            $results[]   = ['rank' => $rank, 'url' => $link];
                        }
                    }
                }
            }








            return $results;
        }
        private function _isCurlEnabled()
        {
            return function_exists('curl_version');
        }

        private function _curl($url, $useproxie, $arrayproxies)
        {
            $ua = [
                0   => 'Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201',
                1  => 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36',
                2  => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1'
            ];
            try {
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_USERAGENT, $ua[rand(0,2)]);
               // curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246');
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
        private function _curl2($continue,$g_recaptcha_response,$sitekey)
        {
            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $userIP = $_SERVER["REMOTE_ADDR"];
            $data = array(
                'secret' => '6Lf67k4UAAAAAPh5I8elxxjjozkBeQctUObL45Eu',
                'response' =>$g_recaptcha_response
            );
            $options = array(
                'http' => array (
                    'method' => 'POST',
                    'content' => http_build_query($data)
                )
            );
            $context  = stream_context_create($options);
            $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf67k4UAAAAAPh5I8elxxjjozkBeQctUObL45Eu&response=$g_recaptcha_response&remoteip=$userIP");
            dd($verify);
            if ($verify->success)
            {
            try {


                $url = "https://ipv4.google.com/sorry/index";
                $data = array("continue" => $continue, "g-recaptcha-response" => $g_recaptcha_response, 'q' => $sitekey, 'data-sitekey' => $sitekey);
                $data_string = json_encode($data);
                // $ch = curl_init($url);
                $ch = curl_init($continue);

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

//                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
//                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//                curl_setopt($ch, CURLOPT_HEADER, true);
//                curl_setopt($ch, CURLOPT_HTTPHEADER,
//                    array('Content-Type:application/json',
//                        'Content-Length: ' . strlen($data_string))
//                );
//                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.135 Safari/537.36 Edge/12.246');
//                curl_setopt($ch, CURLOPT_AUTOREFERER, true);
//                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
//                curl_setopt($ch, CURLOPT_TIMEOUT, 120);
//                curl_setopt($ch, CURLOPT_MAXREDIRS, 1);
//                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//                curl_setopt($ch, CURLOPT_SSLVERSION, 'all');


                $content = curl_exec($ch);
                $errno = curl_errno($ch);
                $error = curl_error($ch);
                curl_close($ch);

                if (!$errno) {
                    return $content;
                } else {
                    return [
                        'errno' => $errno,
                        'errmsg' => $error
                    ];
                }
            } catch (Exception $e) {
                return [
                    'errno' => $e->getCode(),
                    'errmsg' => $e->getMessage()
                ];
            }
        }
        else{
                return 'false';
        }
        }
    }
}