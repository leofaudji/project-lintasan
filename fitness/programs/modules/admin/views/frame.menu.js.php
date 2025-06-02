<script type="text/javascript">
   //angular search
   var app  = angular.module("framemenu",[]) ;

   app.controller('framemenu_controller', function($scope, dataService, modelService) {
   $scope.items = modelService;
   dataService.getJson().then(
      function (res) {
         angular.copy(res.data, modelService);
      },
      function() {
         alert("Error Menus") ;
      }
   );

   $scope.form_desktop	= function(o){
      if(o.toString() !== ''){
         bjs_os.form(o) ;
      }
   }

   });

   app.filter("framemenu_searchfor",function(){
   return function(arr, framemenu_searchstring){
      if(!framemenu_searchstring){
         return arr ;
      }
      var framemenu_RetVal = [] ;
      framemenu_searchstring	= framemenu_searchstring.toLowerCase() ;

      angular.forEach(arr,function(item){
         if(item.name.toLowerCase().indexOf(framemenu_searchstring) > -1){
            framemenu_RetVal.push(item) ;
         }
      }) ;

      return framemenu_RetVal ;
   }
   }) ;

   angular.module("framemenu")
   .factory('dataService', ['$http', function ($http) {
      return {
           getJson: function () {
               return $http.get( base_url + "admin/frame/menu_angular");
           }
      };
   }]);

   angular.module("framemenu")
   .value('modelService', [{"name":"Loading Menus...."}]);
</script>
