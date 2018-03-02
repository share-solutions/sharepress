var exec = require('child_process').exec

module.exports = function (cmd, opts) {
  return new Promise(function (resolve, reject) {
    exec(cmd, opts, function (err, stdout, stderr) {
      if (err) {
        reject(err, stderr)
      } else {
        resolve(stdout)
      }
    })
  })
}
