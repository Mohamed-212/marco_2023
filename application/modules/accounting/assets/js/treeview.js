"use strict";
$(document).ready(function () {
  "use strict";
  $("#coa_jstree").jstree({
    core: {
      themes: {
        icons: false,
      },
    },
    plugins: ["types", "dnd"],

    types: {
      default: {
        icon: "fa fa-folder",
      },
      html: {
        icon: "fa fa-file-code-o",
      },
      svg: {
        icon: "fa fa-file-picture-o",
      },
      css: {
        icon: "fa fa-file-code-o",
      },
      img: {
        icon: "fa fa-file-image-o",
      },
      js: {
        icon: "fa fa-file-text-o",
      },
      attr: {
        class: "panel-heading",
      },
    },
  });
});
