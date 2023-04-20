window._ = require("lodash");

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");

// window.Echo = new Echo({
//   broadcaster: "pusher",
//   key: process.env.MIX_PUSHER_APP_KEY,
//   cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//   wsPort: 80,
//   wssPort: 443,
//   forceTLS: true,
//   enabledTransports: ["ws", "wss"],
// });

window.Echo = new Echo({
  // broadcaster: "pusher",
  // key: process.env.MIX_PUSHER_APP_KEY,
  // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
  // wsHost: process.env.MIX_PUSHER_HOST,
  // wsPort: process.env.MIX_PUSHER_PORT,
  // wssPort: process.env.MIX_PUSHER_PORT,
  // //   forceTLS: false,
  // forceTLS: false,
  // encrypted: true,
  // disableStats: true,
  // enabledTransports: ["ws", "wss"],
  broadcaster: "pusher",
  key: "app-key",
  cluster: "mt-1",
  wsHost: "127.0.0.1",
  wsPort: 6001,
  wssPort: 6001,
  forceTLS: false,
  encrypted: true,
  disableStats: true,
  enabledTransports: ["ws", "wss"],
  //   authorizer: (channel, options) => {
  //     return {
  //       authorize: (socketId, callback) => {
  //         axios
  //           .get("/api/login/jbull635@gmail.com/jimmyBulL1230$")
  //           .then((response) => {
  //             callback(null, response.data);
  //             console.log(response.data);
  //           })
  //           .catch((error) => {
  //             callback(error);
  //             console.log(error);
  //           });
  //       },
  //     };
  //   },
});

// window.Echo.channel("orders").listen("OrderStatusUpdated", (e) => {
//     console.log(e);
// });

// window.Echo.private(`channel-name.4`).listen("OrderStatusUpdated", (e) => {
//   console.log(e);
// });
