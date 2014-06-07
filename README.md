dash-app-relay
==============

Small socket server which listens to for dash lookup requests on a socket and relays them to Dash.app

Dash.app supports a custom URL scheme for plugins:

    open 'dash-plugin://keys=php&query=array'

Just connect to the port (1337) and send the `keys=php&query=array` section and it will be relayed to Dash.app.
