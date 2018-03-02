var execAsync = require('./exec-async')

module.exports = {
  getLast2CommitsWithTags: function (deployTags) {
    var getTaggedCommitCmd = `git rev-list -n1 --format="%h" <tag>`
    var commits = []
    return new Promise(function (resolve, reject) {
      var get = function (index) {
        execAsync(getTaggedCommitCmd.replace(/\<tag\>/g, deployTags[index]))
                    .then(function (res) {
                      var shortHash = res.split('\n')
                      if (commits[commits.length - 1] !== shortHash[1]) {
                        commits.push(shortHash[1])
                      }
                      index++
                      if (index >= deployTags.length || commits.length >= 2) {
                        resolve(commits)
                      } else {
                        get(index)
                      }
                    })
                    .catch(function (err) {
                      reject(err)
                    })
      }
      get(0)
    })
  }
}
