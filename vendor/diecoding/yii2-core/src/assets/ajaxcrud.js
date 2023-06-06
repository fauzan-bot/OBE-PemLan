/*!
 * Ajax Crud
 * =================================
 * Use for johnitvn/yii2-ajaxcrud extension
 * @author John Martin john.itvn@gmail.com
 */
$(document).ready(function() {
	// Create instance of Modal Remote
	// This instance will be the controller of all business logic of modal
	// Backwards compatible lookup of old ajaxCrubModal ID
	if ($("#ajaxCrubModal").length > 0 && $("#ajaxCrudModal").length == 0) {
		selectionModal = "#ajaxCrubModal";
	} else {
		selectionModal = "#ajaxCrudModal";
	}

	modal = new ModalRemote(selectionModal);

	// dissable enter submit
	$(selectionModal).keydown(function(event) {
		if (event.keyCode == 13) {
			event.preventDefault();
			return false;
		}
	});

	// Catch click event on all buttons that want to open a modal
	$(document).on("click", '[role="modal-remote"]', function(event) {
		event.preventDefault();

		// Open modal
		modal.open(this, null);
	});

	// Catch click event on all buttons that want to open a modal
	// with bulk action
	$(document).on("click", '[role="modal-remote-bulk"]', function(event) {
		event.preventDefault();

		// Collect all selected ID's
		var selectedIds = [];
		$('input:checkbox[name="selection[]"]').each(function() {
			if (this.checked) selectedIds.push($(this).val());
		});

		if (selectedIds.length == 0) {
			// If no selected ID's show warning
			modal.show();
			modal.setTitle("Tidak ada data terpilih");
			modal.setContent("Anda setidaknya harus memilih 1 data.");
			this.addFooterButton(
				"Batal",
				"button",
				"btn btn-secondary",
				function(button, event) {
					this.hide();
				}
			);
		} else {
			// Open modal
			modal.open(this, selectedIds);
		}
	});
});
