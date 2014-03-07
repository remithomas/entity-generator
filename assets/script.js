function MainCtrl($scope) {
    $scope.items = [{
        name: 'id',
        type: 'integer'
    }, {
        name: 'name',
        type: 'string'
    }];
    $scope.className = "User";
    $scope.namespace = "My\\Namespace";
    $scope.$parent.hasConstructor = "1";
    $scope.$parent.visibility = "protected";
    
    $scope.add = function() {
        $scope.items.push({name: '',type:''});            
    };
    $scope.render = function() {
        // foreach
    };
}
