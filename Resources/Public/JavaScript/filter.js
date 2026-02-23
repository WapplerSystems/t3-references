document.addEventListener('DOMContentLoaded', () => {
  // Technologie Tags
  const technologyTagItems = document.querySelectorAll('.references__tagFilter input[type="checkbox"]');
  // Industrie Tags
  const industryTagItems = document.querySelectorAll('.references__tagFilter input[type="checkbox"]');
  // Zielgruppen Tags
  const targetGroupTagItems = document.querySelectorAll('.references__tagFilter input[type="checkbox"]');

  // Alle Referenz-Elemente
  const referenceItems = document.querySelectorAll('.references__item');
  console.log('referenceItems:', referenceItems);
  console.log('Anzahl der Referenzen:', referenceItems.length);








  /**referenceItems.forEach(item => {
    // Prüfe, ob das Element eine Klasse enthält, die mit 'reference-tag--' beginnt
    const classList = item.classList;

    // Suche nach Klassen, die mit 'reference-tag--' beginnen
    const referenceTagClasses = Array.from(classList).find(cls => cls.startsWith('reference-tag--'));
    const tagUids = referenceTagClasses.map(cls => cls.replace('reference-tag--', ''));



    // Wenn es gültige Klassen gibt, gebe sie aus
    //if (referenceTagClasses.length  !== null && referenceTagClasses.length  !== undefined ) {
      console.log('Gefundene UId:', tagUids);
    //}
  });*/

  // Event-Listener für Technologie-Tags
  technologyTagItems.forEach(tagItem => {
    tagItem.addEventListener('click', () => {
        const selectedTagUid = tagItem.getAttribute('data-technology-tag');
        console.log('selectedTagUid:', selectedTagUid);

        let elemts = document.querySelectorAll( '.reference__item.reference-tag--'+selectedTagUid);
      console.log('elemts:', elemts);

      // Iteriere über die gefilterten Elemente
      [...elemts].forEach(filteredItem => {
        console.log('filteredItem:', filteredItem);

        filteredItem.style.display = 'block';


        /**
       let children = referenceItems.children;
        console.log('children ',children);
        if (children.length > 0) {
          for (let i = 0; i < children.length; i++) {
            if ( children[i].classList.contains(filteredItem.className)) {
              children[i].style.display = 'block';
            }else{
              children[i].style.display = 'none';
            }
          }
          console.log('GefundenesElement');
        }
        else {
          // Andernfalls blende es aus
          filteredItem.style.display ='none';
        }
      });*/

      //Blende alle anderen referenceItems aus
      /**referenceItems.forEach(referenceItem => {
        if ([...elemts].includes(referenceItem)) {
          referenceItem.style.display = 'none'; // Blende nicht gefilterte Items aus
        }*/
      });
    });
  });


  // Event-Listener für Industrie-Tags
  /**industryTagItems.forEach(tagItem => {
    tagItem.addEventListener('click', () => {
      const selectedTagUid = tagItem.getAttribute('data-industry-tag');
      filterReferences(selectedTagUid, 'industryTags');
    });
  });

  // Event-Listener für Zielgruppen-Tags
  targetGroupTagItems.forEach(tagItem => {
    tagItem.addEventListener('click', () => {
      const selectedTagUid = tagItem.getAttribute('data-targetgroup-tag');
      filterReferences(selectedTagUid, 'targetGroupTags');
    });
  });*/

  // Alle anzeigen Button
  const showAllButton = document.createElement('button');
  showAllButton.textContent = 'Alle anzeigen';
  document.querySelector('.references__tagFilter').parentElement.appendChild(showAllButton);

  showAllButton.addEventListener('click', () => {
    referenceItems.forEach(referenceItem => {
      referenceItem.style.display = 'block';
    });
    console.log('Alle Referenzen werden angezeigt.');
  });
});
