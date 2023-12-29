# AutoMod

A simple plugin to automatically mute people who say the words selected in the config

If you have any problems please create an issue I will try to answer them as soon as possible. And feel free to star the project

Finally, if you are looking for private plugins at a good price, I can make some on my discord: yakuuuuuuuuuuuuuuu_

### Config

```yaml
insult:
  on: true
  words: ["shut up", "stfu"]
  mute-time: 30
  mute-broadcastmessage: "{player} was muted by automod for {time} for insult"
  mute-message: "u have been muted for insult for {time}"
provoc:
  on: true
  words: ["ez", "easy"]
  mute-time: 30
  mute-broadcastmessage: "{player} was muted by automod for {time} for provoc"
  mute-message: "u have been muted for provoc for {time}"

always-mute: "You are still muted for {time} for {reason}"
```