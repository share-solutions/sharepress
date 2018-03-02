var fs = require('fs'),
  execAsync = require('./exec-async')

var writeFolderFilesList = function (basePath, folder) {
  return new Promise(function (resolve, reject) {
    var textFileName
    if (fs.lstatSync(basePath + folder).isDirectory()) {
      textFileName = folder.replace(/\//g, '_') + '.txt'
      execAsync(`cd ${basePath} && find ${folder} -type f | sed -e 's,folder/,\",' -e 's/$//' > ${textFileName}`)
                .then(function () {
                  resolve(textFileName)
                })
    } else {
      textFileName = folder.replace(/(\/|\.)/g, '_') + '.txt'
      execAsync(`cd ${basePath} && echo "${folder}" > ${textFileName}`)
                .then(function () {
                  resolve(textFileName)
                })
    }
  })
}

module.exports = {
  putIncludedFoldersToTextFiles: function (basePath, includesList) {
    return new Promise(function (resolve, reject) {
      var ret = []
      var get = function (index) {
        writeFolderFilesList(basePath, includesList[index])
                    .then(function (filename) {
                      ret.push(filename)
                      index++
                      if (index >= includesList.length) {
                        resolve(ret)
                      } else {
                        get(index)
                      }
                    })
      }
      get(0)
    })
  },
    // make promise version of fs.readFile()
  readFileAsync: function (filename, encoding) {
    return new Promise(function (resolve, reject) {
      fs.readFile(filename, encoding, function (err, data) {
        if (err) { reject(err) } else { resolve(data) }
      })
    })
  },
    // make promise version of fs.readFile()
  writeFileAsync: function (filename, content) {
    return new Promise(function (resolve, reject) {
      fs.writeFile(filename, content, function (err, data) {
        if (err) { reject(err) } else { resolve(data) }
      })
    })
  }
}
