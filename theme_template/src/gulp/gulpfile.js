var requireDir = require("require-dir");
// require all tasks in gulp/tasks, including sub-folders
requireDir("./tasks/", {
    recurse: true
});