# Xp Counter

## Setup

The main installation is done with docker-compose:

- ```cp .env.example .env``` (.env.example is adapted for docker)
- ```[sudo] docker-compose up -d --build```
- ```[sudo] sh ./Docker/post-install.sh```
- If you are on linux, you need to execute the commands from the file above manually (or make .bat file)

## Variables

- local url is <a href="http://xp-counter.local">http://xp-counter.local</a>
- pgadmin url is <a href="http://localhost:8888">http://localhost:8888</a>

## Usage

The login is done with Telegram fake validation and the authorization is done with Sanctum.
Real Telegram validation is not implemented but the function are prepared for it.

- The POST request http://xp-counter.local/api/start is used to log in with a single parameter ```username``` (like in Telegram api). it returns the next response:<br/>
```
{
    "user": {
        "id": ,
        "name": "",
        "email": "",
        "xp": 0,
        "level": 1,
        "last_request_at": ""
    },
    "token": ""
}
```
- Token needs to be used for any other requests.
- The GET request http://xp-counter.local/api/progress is used to get the user info without updating it.
- The POST request http://xp-counter.local/api/earn updates and returns the updated user info.