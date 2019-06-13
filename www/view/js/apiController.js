/**
  * @ngdoc service
  * @name hellscripts.services
  * 
  * @description
  * Performs all the authorized requests to the internal api
**/
hellscripts.factory("services", ['$http', '$q', '$cookies',function ($http, $q, $cookies) {
   var serviceBase = 'api/';
   var obj = {};
   var token = $cookies.get('token');
   if (token == null) token = '';
   obj.get = function (module, get) {
      var defered=$q.defer();
      var promise=defered.promise;
      var query='';
      if (typeof get === 'object' && get !== null){
         for(var key in get) {
            query=query.concat('/'+key+'-'+get[key]);
         }
      }
      $http({
         method: 'GET',
         url: serviceBase + module + query,
         headers: {
            'Authorization': $cookies.get('token')
         },
         }).success(function(data, status, headers, config) {
            defered.resolve(data);
         }).error(function(data, status, headers, config) {
            console.log(data);
            defered.reject(data);
      });
      return promise;
   };

   obj.getFile = function (url){
      var defered=$q.defer();
      var promise=defered.promise;
      $http({
         method: 'GET',
         url: url
         }).success(function(data, status, headers, config) {
            defered.resolve(data);
         }).error(function(data, status, headers, config) {
            console.log(data);
            defered.reject(data);
      });
      return promise;
   }  

   obj.post = function (module, data) {

      var defered=$q.defer();
      var promise=defered.promise;
      $http({
         method: 'POST',
         url: serviceBase + module,
         data: {data: JSON.stringify(data)},
         headers: {
            'Authorization': $cookies.get('token')
         },
         }).success(function(data, status, headers, config) {
            console.log(data);
            defered.resolve(data);
         }).error(function(data, status, headers, config) {
            console.log(data);
            defered.reject(data);
      });
      return promise;
   };

   obj.put = function (module, get, data) {
      var defered=$q.defer();
      var promise=defered.promise;
      var query='';
      var query='';
      if (typeof get === 'object' && get !== null){
         for(var key in get) {
            query=query.concat('/'+key+'-'+get[key]);
         }
      }
      $http({
         method: 'PUT',
         url: serviceBase + module + query,
         data: {data: JSON.stringify(data)},
         headers: {
            'Authorization': $cookies.get('token')
         },
         }).success(function(data, status, headers, config) {
            defered.resolve(data);
         }).error(function(data, status, headers, config) {
            console.log(data);
            defered.reject(data);
      });
      return promise;
   };

   obj.delete = function (module, get) {
      var defered=$q.defer();
      var promise=defered.promise;
      var query='';
      if (typeof get === 'object' && get !== null){
         for(var key in get) {
            query=query.concat('/'+key+'-'+get[key]);
         }
      }
      console.log(query);
      $http({
         method: 'DELETE',
         url: serviceBase + module + query,
         headers: {
            'Authorization': $cookies.get('token')
         },
         }).success(function(data, status, headers, config) {
            defered.resolve(data);
         }).error(function(data, status, headers, config) {
            console.log(data);
            defered.reject(data);
      });
      return promise;
   };
   return obj;
}]);