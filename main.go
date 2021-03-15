package main

import (
	"github.com/joho/godotenv"
	"github.com/maxisme/appserver"
	"os"
)

func main() {
	// load .env if there
	_ = godotenv.Load()

	conf := appserver.ProjectConfig{
		Name:          "notifi",
		Host:          "notifi.it",
		GithubDmgRepo: "maxisme/notifi",
		KeyWords:      "notifi, notifi it, notify, notification, push notification, curl, mac, osx, mac to mac",
		Description:   "Send simple push notifications to your Mac using HTTP.",
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
			Host:     os.Getenv("emailhost"),
			Port:     587,
			Username: os.Getenv("emailusername"),
			Password: os.Getenv("emailpassword"),
		},
		WebPort: 8080,
	}

	if err := appserver.Serve(conf); err != nil {
		panic(err)
	}
}
