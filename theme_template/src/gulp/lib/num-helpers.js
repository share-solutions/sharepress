module.exports = {
  padNumber: function (num, pad) {
    return String(pad + num).substr(-(pad.length))
  }
}
