package main

import (
	"github.com/maxisme/appserver"
)

func main() {
	conf := appserver.ProjectConfig{
		Name: "notifi",
		Host: "notifi.it",
		DmgPath: "notifi.dmg",
		KeyWords: "notifi, notifi it, notify, notification, push notification, curl, mac, osx, mac to mac",
		Description: "Send simple push notifications to your Mac using HTTP.",
		Recaptcha: appserver.Recaptcha{
			Pub: "LcbhkgUAAAAAIe6ZSvN9SQ8KaWgLb56xVUK82Ds",
			Priv: "6LcbhkgUAAAAABuigVIcuHf_9DwOCcifC-ny_IwQ",
		},
		Sparkle: appserver.Sparkle{
			Version:"11.0",
			Description:"foo",
		},
	}

	if err := appserver.Serve(conf); err != nil {
		panic(err)
	}
}
