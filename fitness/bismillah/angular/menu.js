//angular search
var app  = angular.module("OBJSEARCH",[]) ;

app.controller('OBJSEARCH_Controller', function($scope, dataService, modelService) {
  $scope.items = modelService;
  dataService.getJson().then(
    function (res) {
    	angular.copy(res.data, modelService);
    },
    function() {
    	alert("Error Menus") ;
    }
  );

  $scope.OpenForm	= function(oJson){
    if(oJson !== '{}'){
      oJson       = JSON.parse(oJson);
      scOSX.Form(oJson) ;
    }
  }

});

app.filter("OBJSEARCH_SearchFor",function(){
	return function(arr, OBJSEARCH_SearchString){
		if(!OBJSEARCH_SearchString){
			return arr ;
		}
		var OBJSEARCH_RetVal = [] ;
		OBJSEARCH_SearchString	= OBJSEARCH_SearchString.toLowerCase() ;

		angular.forEach(arr,function(item){
			if(item.cNama.toLowerCase().indexOf(OBJSEARCH_SearchString) > -1){
				OBJSEARCH_RetVal.push(item) ;
			}
		}) ;

		return OBJSEARCH_RetVal ;
	}
}) ;

angular.module("OBJSEARCH")
.factory('dataService', ['$http', function ($http) {
    return {
        getJson: function () {
            return $http.get('./sc.menubar.php');
        }
    };
}]);

angular.module("OBJSEARCH")
.value('modelService', [{"cNama":"Loading Menus...."}]); 
