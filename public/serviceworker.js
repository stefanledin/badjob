importScripts("precache-manifest.8106f6099f161622818917ca6c9bc3f7.js", "https://storage.googleapis.com/workbox-cdn/releases/3.0.1/workbox-sw.js");

importScripts('https://storage.googleapis.com/workbox-cdn/releases/3.0.0/workbox-sw.js');

if (workbox) {
    console.log(`Yay! Workbox is loaded 🎉`);
    console.log(self.__precacheManifest || []);
} else {
    console.log(`Boo! Workbox didn't load 😬`);
}

workbox.routing.registerRoute(
    new RegExp('.*\.js'),
    workbox.strategies.networkFirst()
);
