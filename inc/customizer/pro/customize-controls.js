( function( api ) {

	// Extends our custom "checathlon-pro-link" section.
	api.sectionConstructor['checathlon-pro-link'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
