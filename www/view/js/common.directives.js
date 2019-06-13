
/**
  * @ngdoc directive
  * @name js.directive:hellscripts.directive'dropzone', 
  * @description
  * Dropzone directive to be able to upload files to the page
**/
hellscripts.directive('dropzone', function () {
  return function (scope, element, attrs) {
    var config, dropzone;

    config = scope[attrs.dropzone];

    // create a Dropzone for the element with the given options
    dropzone = new Dropzone(element[0], config.options);

    // bind the given event handlers
    angular.forEach(config.eventHandlers, function (handler, event) {
      dropzone.on(event, handler);
    });
  };
});