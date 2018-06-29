// angular.module('orderBookApp').directive('fileUploadInput', function ($window) {
//     return {
//         template: '<div class="input-group"> ' +
//                             '<label class="input-group-btn"> ' +
//                                 '<span class="btn btn-primary"> Browse&hellip; <input id="file" type="file" name="fileInput" style="display: none;" accept=".csv" required> ' +
//                                 '</span>' +
//                             ' </label> ' +
//                             '<input type="text" id="fileName" value="" class="form-control" readonly> ' +
//                         '</div> ' +
//                    '<span class="help-block" ><i class="fa fa-info-circle" uib-tooltip="Format of CSV file: address_type, name, lat, lng, tag"></i> Select a file that you want to upload. </span>',
//         // scope:{
//         //     fileModel: '='
//         // },
//         restrict: 'E',
//         require: 'ngModel',
//         link: function postLink(scope, element, attr, ctrl)
//         {
//             // var validFormats = ['.csv', '.xlsx', '.xls'];
//             var fileExt, fileName;
            
//             element.bind('change', function(e)
//             {
//                 fileName = e.target.files[0];
//                 fileExt = '';
//                 fileExt = fileName.name;
//                 fileExt = fileName.name.substring(fileExt.lastIndexOf('.'));
//                 // if(validFormats.indexOf(fileExt) !== -1)
//                 // {
//                     var file = document.getElementById('fileName').value = fileName.name;
//                     ctrl.$setViewValue(e.target.files[0]);
//                 // }


//             });
//         }
//     }
// });

angular.module('orderBookApp').directive('fileInput', function () {
    return {
        link: function (scope, element) {
            element.css({
                position: 'relative',
                overflow: 'hidden',
                cursor: 'pointer'
            });

            var fileInput = angular.element(element.children()[1]);
            fileInput.css({
                position: 'absolute',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                opacity: '0',
                cursor: 'pointer'
            });
        }
    };
});

angular.module('orderBookApp').directive('fModel', function ($parse) {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var model = $parse(attrs.fModel);
            var modelSetter = model.assign;
            var preview = attrs.imagePreview;

            var changePreview = function () {
                if (preview) {
                    var fModel = $parse(attrs.imagePreview);
                    var fModelSetter = fModel.assign;
                    var reader = new FileReader();
                    reader.onloadend = function () {
                        fModelSetter(scope, reader.result);
                    };
                    reader.readAsDataURL(element[0].files[0]);
                }
            };
            var errorMessage = function (flag) {
                var errorTag = document.getElementById('errorMessage');
                if(errorTag){
                    if(flag && errorTag.classList.contains('hide')){
                        errorTag.classList.remove('hide');
                        scope.aux.imgError = true;
                    }else{
                        errorTag.classList.add('hide');
                        scope.aux.imgError = false;
                    }
                }
            };

            element.bind('change', function(){
                scope.$apply(function(){
                    var reader = new FileReader();
                    var image = new Image();
                    reader.onload = function (_file)
                    {
                        if(_file.target.result.split('/')[0] != 'data:application' && _file.target.result.split('/')[0] != 'data:text')
                        {
                            image.src = _file.target.result;
                            image.onload = function ()
                            {
                                    errorMessage(false);
                                    modelSetter(scope, element[0].files[0]);
                                    try {
                                        changePreview();
                                    }
                                    catch (e)
                                    {
                                    //do nothing
                                    }
                            }
                        }
                        else
                        {
                            modelSetter(scope, element[0].files[0]);
                        }
                    };
                    if(element[0].files[0])
                    reader.readAsDataURL(element[0].files[0]);
                });
            });

        }
    };
});