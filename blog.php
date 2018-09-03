<?php
class getBlogUserInfo
{
    protected $baseUrl;
    const USER_COOKIE = '.';

    public function __construct($url)
    {
        $this->baseUrl = $url;
    }

    public function getHome($url)
    {
        $siteUrl = $this->baseUrl . trim($url, '/');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // TRUE 将curl_exec()获取的信息以字符串返回，而不是直接输出。
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // TRUE 时将会根据服务器返回 HTTP 头中的 "Location: " 重定向。（注意：这是递归的，"Location: " 发送几次就重定向几次，除非设置了 CURLOPT_MAXREDIRS，限制最大重定向次数。）。
        // curl_setopt($ch, CURLOPT_NOBODY, 1); // TRUE 时将不输出 BODY 部分。同时 Mehtod 变成了 HEAD。修改为 FALSE 时不会变成 GET。
        // curl_setopt($ch, CURLOPT_POST, 1); // 请求方式为 POST，类型为：application/x-www-form-urlencoded。
        curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, 1); // 在尝试连接时等待的秒数。设置为0，则无限等待。
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 在尝试连接时等待的秒数。设置为0，则无限等待。
        curl_setopt($ch, CURLOPT_URL, $siteUrl);
        curl_setopt($ch, CURLOPT_COOKIE, self::USER_COOKIE);

        $content = curl_exec($ch);
        preg_match_all($this->url_reg, $content, $url_match);
    }
}

$base_url = 'https://home.cnblogs.com/';
$blog = new getBlogUserInfo($base_url);
$blog->getHome('u/');
