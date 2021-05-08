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
		KeyWords:      "notifi, notifi it, notify, notification, push notification, curl, mac, osx, mac to mac, ios, flutter",
		Description:   "Send simple push notifications to your MacOS and iOS devices using HTTP.",
		Recaptcha: appserver.Recaptcha{
			Pub:  os.Getenv("captchpub"),
			Priv: os.Getenv("captchpriv"),
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
