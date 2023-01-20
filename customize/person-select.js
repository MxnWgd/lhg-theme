var persons = [];

jQuery(document).ready(function() {
  //load selected persons
  var persons_string = jQuery('#personsInput').val();
  persons = persons_string != null ? persons_string.split(',') : [];

  persons.forEach((p) => {
    if (p != '') {
      addPersonElement(p);
    }
  });


  //add element
  jQuery('.available-persons-element').click(function (e) {
    var id = jQuery(e.target).closest('li').attr('person-id');
    jQuery(e.target).closest('li').remove();
    addPersonElement(id);

    persons.push(id);
    jQuery('#personsInput').val(persons).trigger('change');
  });

});


function addPersonElement(id) {
  jQuery('.persons-list').append('\
    <li class="persons-element" person-id="' + id + '">\
      <div class="persons-thumbnail"></div>\
      <span class="persons-name"></span>\
      <div class="persons-move-buttons">\
        <button class="persons-move-button move-up" title="Nach oben" onclick="moveUpPerson(event, ' + id + ')">&#9652;</button>\
        <button class="persons-move-button move-down" title="Nach unten" onclick="moveDownPerson(event, ' + id + ')">&#9662;</button>\
      </div>\
      <button class="persons-element-delete" title="Löschen" onclick="deletePerson(event, ' + id + ')">X</button>\
    </li>\
  ');

  jQuery.ajax({
    url: "/wp-admin/admin-ajax.php",
    type: "POST",
    data: {'id' : id, 'action': 'person_select_data'},
    dataType:'json',
    success: function(response) {
      jQuery('.persons-element[person-id="' + id + '"] .persons-name').append(response['name']);

      if (response['thumb'] != false) {
        jQuery('.persons-element[person-id="' + id + '"] .persons-thumbnail').attr('style', 'background-image: url("' + response['thumb'] + '")');
      }
    }
  });
}

function addAvailablePersonElement(id) {
  jQuery('.available-persons-list').append('\
    <li class="available-persons-element" person-id="' + id + '" onclick="addPerson(event, ' + id + ')">\
      <div class="available-persons-thumbnail"></div>\
      <span class="available-persons-name"></span>\
    </li>\
  ');

  jQuery.ajax({
    url: "/wp-admin/admin-ajax.php",
    type: "POST",
    data: {'id' : id, 'action': 'person_select_data'},
    dataType:'json',
    success: function(response) {
      jQuery('.available-persons-element[person-id="' + id + '"] .available-persons-name').append(response['name']);

      if (response['thumb'] != false) {
        jQuery('.available-persons-element[person-id="' + id + '"] .available-persons-thumbnail').attr('style', 'background-image: url("' + response['thumb'] + '")');
      }
    }
  });
}

function deletePerson(e, id) {
  e.preventDefault();
  i = id.toString();

  //remove element from list
  jQuery(e.target).closest('li').remove();

  //refresh input value
  persons.splice(persons.indexOf(i), 1);
  jQuery('#personsInput').val(persons.join(',')).trigger('change');

  //add element to available persons list
  addAvailablePersonElement(id);
  return false;
}

function deleteAllPersons() {
  if (confirm('Möchtest du wirklich alle Personen von der Startseite entfernen und die Liste zurücksetzen?')) {
    persons.forEach((item, i) => {
      addAvailablePersonElement(item);
    });

    jQuery('.persons-element').remove();

    persons = [];
    jQuery('#personsInput').val('').trigger('change');
  }
}

function addPerson(e, id) {
  i = id.toString();

  jQuery(e.target).closest('li').remove();
  addPersonElement(i);

  persons.push(i);
  jQuery('#personsInput').val(persons).trigger('change');
  return false;
}

function moveUpPerson(e, id) {
  e.preventDefault();
  i = id.toString();

  //update view
  jQuery(e.target).closest('li').insertBefore(jQuery(e.target).closest('li').prev());

  //update persons
  pos = persons.indexOf(i);
  persons.splice(pos, 1);
  persons.splice(pos - 1, 0, i);

  jQuery('#personsInput').val(persons).trigger('change');
  return false;
}

function moveDownPerson(e, id) {
  e.preventDefault();
  i = id.toString();

  //update view
  jQuery(e.target).closest('li').insertAfter(jQuery(e.target).closest('li').next());

  //update persons
  pos = persons.indexOf(i);
  persons.splice(pos, 1);
  persons.splice(pos + 1, 0, i);

  jQuery('#personsInput').val(persons).trigger('change');
  return false;
}
