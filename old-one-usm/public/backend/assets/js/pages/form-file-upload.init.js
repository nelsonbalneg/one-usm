/*
Template Name: Tailwick - Admin & Dashboard Template
Author: Themesdesign
Website: https://themesdesign.in/
Contact: Themesdesign@gmail.com
File: Form file upload Js File
*/

// psa dropzone
// document.addEventListener("DOMContentLoaded", function () {
//     Dropzone.autoDiscover = false; // Prevent auto initialization

//     var dropzoneForm = document.getElementById("dropzone");
//     const previewTemplate = document.querySelector(
//         "#dz-preview-template"
//     ).outerHTML;
//     document.querySelector("#dz-preview-template").remove();

//     if (dropzoneForm) {
//         var dropzone = new Dropzone("#dropzone", {
//             url: "/student/applicant-requirements",
//             method: "post",
//             headers: {
//                 "X-CSRF-TOKEN": document
//                     .querySelector('meta[name="csrf-token"]')
//                     .getAttribute("content"),
//             },
//             paramName: "psa_files",
//             uploadMultiple: true,
//             previewsContainer: "#dropzone-preview",
//             previewTemplate: previewTemplate,
//             acceptedFiles: ".jpg,.jpeg,.png,.pdf",
//             maxFilesize: 10,
//             addRemoveLinks: true,
//             success: function (file, response) {
//                 console.log("Upload successful:", response);
//             },
//             error: function (file, response) {
//                 console.log("Upload error:", response);
//             },
//         });

//         // Handle design preservation
//         dropzone.on("addedfile", function () {
//             document
//                 .querySelector("#dropzone-preview")
//                 .classList.remove("empty");
//         });

//         dropzone.on("removedfile", function () {
//             if (dropzone.files.length === 0) {
//                 document
//                     .querySelector("#dropzone-preview")
//                     .classList.add("empty");
//             }
//         });
//     }
// });

document.addEventListener("DOMContentLoaded", function () {
    var dropzoneForm = document.getElementById("dropzone");

    if (dropzoneForm) {
        //  var uploadUrl = dropzoneForm.getAttribute("data-upload-url"); // Get correct Laravel route

        var dropzone = new Dropzone(".dropzone", {
            url: "/student/applicant-requirements", // Use dynamically set route
            method: "post",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            paramName: "psa_files", // Must match Laravel field name
            uploadMultiple: true,
            previewsContainer: "#dropzone-preview",
            acceptedFiles: ".jpg,.jpeg,.png,.pdf",
            maxFilesize: 10, // 10MB max file size
            addRemoveLinks: true,
            success: function (file, response) {
                console.log("Upload successful:", response);
            },
            error: function (file, response) {
                console.log("Upload error:", response);
            },
        });
    }
});

// var dropzonePreviewNode = document.querySelector("#dropzone-preview-list");
// dropzonePreviewNode.id = "";
// if (dropzonePreviewNode) {
//     var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
//     dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
//     var dropzone = new Dropzone(".dropzone", {
//         url: "/student/applicant-requirements",
//         method: "post",
//         previewTemplate: previewTemplate,
//         previewsContainer: "#dropzone-preview",
//     });
// }

// Dropzone
var dropzonePreviewNode = document.querySelector("#dropzone-preview-list2");
dropzonePreviewNode.id = "";
if (dropzonePreviewNode) {
    var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
    dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
    var dropzone = new Dropzone(".dropzone2", {
        url: "https://httpbin.org/post",
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview2",
    });
}

// Dropzone SHS Card
var dropzonePreviewNode = document.querySelector("#dropzone-preview-list3");
dropzonePreviewNode.id = "";
if (dropzonePreviewNode) {
    var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
    dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
    var dropzone = new Dropzone(".dropzone3", {
        url: "https://httpbin.org/post",
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview3",
    });
}

// Dropzone Enrollment Certification
var dropzonePreviewNode = document.querySelector("#dropzone-preview-list4");
dropzonePreviewNode.id = "";
if (dropzonePreviewNode) {
    var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
    dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
    var dropzone = new Dropzone(".dropzone4", {
        url: "https://httpbin.org/post",
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview4",
    });
}

// Dropzone Honorable Dismisal
var dropzonePreviewNode = document.querySelector("#dropzone-preview-list5");
dropzonePreviewNode.id = "";
if (dropzonePreviewNode) {
    var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
    dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
    var dropzone = new Dropzone(".dropzone5", {
        url: "https://httpbin.org/post",
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview5",
    });
}

// Dropzone Honorable Dismisal
var dropzonePreviewNode = document.querySelector("#dropzone-preview-list6");
dropzonePreviewNode.id = "";
if (dropzonePreviewNode) {
    var previewTemplate = dropzonePreviewNode.parentNode.innerHTML;
    dropzonePreviewNode.parentNode.removeChild(dropzonePreviewNode);
    var dropzone = new Dropzone(".dropzone6", {
        url: "https://httpbin.org/post",
        method: "post",
        previewTemplate: previewTemplate,
        previewsContainer: "#dropzone-preview6",
    });
}
