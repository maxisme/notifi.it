package main

import (
	"github.com/joho/godotenv"
	"github.com/maxisme/appserver"
	"os"
)

func main() {
	// load .env
	if err := godotenv.Load(); err != nil {
		panic(err)
	}

	conf := appserver.ProjectConfig{
		Name:        "notifi",
		Host:        "notifi.it",
		DmgPath:     "notifi.dmg",
		KeyWords:    "notifi, notifi it, notify, notification, push notification, curl, mac, osx, mac to mac",
		Description: "Send simple push notifications to your Mac using HTTP.",
		Recaptcha: appserver.Recaptcha{
			Pub:  os.Getenv("captchpub"),
			Priv: os.Getenv("captchpriv"),
		},
		Sparkle: appserver.Sparkle{
			Version:     "0.1",
			Description: "foo",
		},
		Email: appserver.Email{
			To:       "max@max.me.uk",
			Host:     os.Getenv("host"),
			Port:     587,
			Username: os.Getenv("username"),
			Password: os.Getenv("password"),
		},
	}

	if err := appserver.Serve(conf); err != nil {
		panic(err)
	}
}
