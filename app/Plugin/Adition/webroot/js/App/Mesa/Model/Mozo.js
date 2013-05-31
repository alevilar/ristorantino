(function ( mesaApp , Mesas ) {
	mesaApp.Model.Mozo = Backbone.RelationalModel.extend({
		
		relations: [{
			type: Backbone.HasMany,
			key: 'mesas',
			relatedModel: mesaApp.Model.Mesa,
			collectionType: mesaApp.Collection.Mesas,
			reverseRelation: {
				key: 'mozo',
				includeInJSON: 'id'
				// 'relatedModel' is automatically set to 'Zoo'; the 'relationType' to 'HasOne'.
			}
		}]
	    
	});
})(App.mesaApp, App.mesaApp.Collection.Mesas);
