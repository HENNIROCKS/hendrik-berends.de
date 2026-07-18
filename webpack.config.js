const path = require("path");

module.exports = {
  mode: "production",
  entry: "./src/index.js",
  output: {
    filename: "script.min.js",
    path: path.resolve(__dirname, "assets/js"),
  },
  devtool: "source-map",
};
