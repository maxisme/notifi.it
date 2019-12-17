<p align="center"><img height="150px" src="https://github.com/maxisme/notifi/raw/master/notifi/images/bell.png"></p>

# [notifi.it](https://notifi.it/)

## [Mac App](https://github.com/maxisme/notifi) | Website | [Backend](https://github.com/maxisme/notifi-backend)

## Usage
- First download [notifi](https://notifi.it/download)
- Create a HTTP request using your chosen method, with the following params:
  - `credentials` (your credentials given to you by the client-side app) - **Required**
  - `title` (notification title) - **Required**
  - `message` (notification body) - _Optional_
  - `image` (image to send with the notification) - _Optional_
  - `link` (url to send with the notification) - _Optional_
- Requests are sent to `https://notifi.it/api`

## HTTP Request Examples

#### Curl
```
curl -d "credentials=<credentials>" \
-d "title=New download" \
-d "message=Lorem Ipsum" \
-d "link=https://google.com" \
-d "image=https://imgur.com/someimage.png" \
https://notifi.it/api
```

#### Python
```python
import requests
data = {
  'credentials': '<credentials>',
  'title': 'New download',
  'message': 'Lorem Ipsum',
  'link': 'https://google.com',
  'image': 'https://imgur.com/someimage.png'
}

requests.post(('https://notifi.it/api', data=data))
```

#### PHP
```
curl_setopt_array(
  $chpush = curl_init(),
  array(
    CURLOPT_URL => "https://notifi.it/api",
    CURLOPT_POSTFIELDS => array(
      "credentials" => '<credentials>',
      "title" => 'New download',
      "message" => 'Lorem Ipsum',
      "link" => 'https://google.com',
      "image" => 'https://imgur.com/someimage.png',
    )
  )
);
curl_exec($chpush);
curl_close($chpush);
```

___

Jobs for this page template
 - create a logo.
 	- Creat a .ico for website using `imgToICO.sh`
 - add custom html pages to `pages/`
 - get captcha keys - https://www.google.com/recaptcha/admin#list
 	- Modify `captcha-handler.js` and `send-email.php` with keys
 - record video of app using quicktime
 	- convert to gif using `giphit.sh`
 - modify `download.php` .dmg path
 - record video of app using quicktime and then convert to gif (25fps 1200px) using Drop To Gif
