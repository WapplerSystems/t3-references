/*
 * Filterleiste der Referenzliste.
 *
 * Ohne dieses Skript ist das Formular ein gewoehnliches GET-Formular: auswaehlen,
 * "Suchen" druecken, Seite neu laden. Mit dem Skript loest schon die Auswahl
 * selbst das Nachladen aus, und ausgetauscht wird nur der Ergebnisbereich unter
 * der Leiste - der Fokus bleibt damit im gerade bedienten Auswahlfeld, und die
 * Seite springt nicht an den Anfang.
 *
 * Die Adresse wird mitgefuehrt, damit Zurueck, Vor und Lesezeichen weiter das
 * tun, was man von ihnen erwartet. Geht das Nachladen schief, uebernimmt ein
 * normaler Seitenwechsel - lieber ein Neuladen als eine Liste, die nicht zur
 * Auswahl passt.
 */
(function () {
    'use strict';

    var LAUFEND = 'reference__results--busy';

    function einrichten(formular) {
        if (formular.dataset.referenceFilterBereit) {
            return;
        }
        formular.dataset.referenceFilterBereit = '1';

        var ergebnisse = document.getElementById(formular.dataset.referenceResults);
        if (!ergebnisse) {
            return;
        }

        // Der Knopf bleibt im Markup, damit er ohne JavaScript da ist; hier
        // uebernimmt die Auswahl selbst, er waere nur noch ein zweiter Weg.
        var knopf = formular.querySelector('[data-reference-submit]');
        if (knopf) {
            knopf.hidden = true;
        }

        var laufend = null;

        function adresseAusFormular() {
            var adresse = new URL(formular.action, window.location.href);
            var daten = new FormData(formular);
            daten.forEach(function (wert, name) {
                // Leere Auswahl heisst "kein Filter", und die Formularinterna
                // von f:form (__referrer, __trustedProperties) gehoeren nicht
                // in eine Adresse, die jemand kopieren oder merken soll.
                if (wert !== '' && name.indexOf('[__') === -1) {
                    adresse.searchParams.append(name, wert);
                }
            });
            return adresse.toString();
        }

        function holen(adresse, inGeschichte) {
            if (laufend) {
                laufend.abort();
            }
            var dieser = new AbortController();
            laufend = dieser;
            ergebnisse.classList.add(LAUFEND);
            ergebnisse.setAttribute('aria-busy', 'true');

            fetch(adresse, {
                signal: dieser.signal,
                credentials: 'same-origin',
                headers: { 'X-Requested-With': 'fetch' }
            })
                .then(function (antwort) {
                    if (!antwort.ok) {
                        throw new Error('HTTP ' + antwort.status);
                    }
                    return antwort.text();
                })
                .then(function (text) {
                    var geholt = new DOMParser().parseFromString(text, 'text/html');
                    var neu = geholt.getElementById(ergebnisse.id);
                    if (!neu) {
                        throw new Error('Ergebnisbereich nicht in der Antwort');
                    }

                    ergebnisse.innerHTML = neu.innerHTML;

                    // Die Auswahlfelder nachziehen: ueber ein Chip oder das
                    // Zuruecksetzen aendert sich die Auswahl, ohne dass jemand
                    // ein Feld angefasst haette.
                    var geholteFelder = geholt.querySelectorAll('[data-reference-filter="form"] select');
                    var eigeneFelder = formular.querySelectorAll('select');
                    if (geholteFelder.length === eigeneFelder.length) {
                        eigeneFelder.forEach(function (feld, i) {
                            feld.value = geholteFelder[i].value;
                        });
                    }

                    if (inGeschichte) {
                        window.history.pushState({ referenceFilter: formular.dataset.referenceResults }, '', adresse);
                    }
                })
                .catch(function (fehler) {
                    if (fehler.name === 'AbortError') {
                        return;
                    }
                    // Lieber ein ehrlicher Seitenwechsel als eine Liste, die
                    // nicht zur Auswahl passt.
                    window.location.href = adresse;
                })
                .then(function () {
                    // Nur aufraeumen, wenn inzwischen keine neuere Anfrage
                    // laeuft - sonst nimmt die abgebrochene der nachfolgenden
                    // ihren Ladezustand wieder weg.
                    if (laufend === dieser) {
                        ergebnisse.classList.remove(LAUFEND);
                        ergebnisse.removeAttribute('aria-busy');
                        laufend = null;
                    }
                });
        }

        formular.addEventListener('change', function (ereignis) {
            if (ereignis.target.tagName === 'SELECT') {
                holen(adresseAusFormular(), true);
            }
        });

        formular.addEventListener('submit', function (ereignis) {
            ereignis.preventDefault();
            holen(adresseAusFormular(), true);
        });

        // Blaettern und die Filter-Chips laufen ueber denselben Weg.
        ergebnisse.addEventListener('click', function (ereignis) {
            var verweis = ereignis.target.closest('a.reference__pagination-link, a.reference__filter-chip');
            if (!verweis || ereignis.metaKey || ereignis.ctrlKey || ereignis.shiftKey || ereignis.button !== 0) {
                return;
            }
            ereignis.preventDefault();
            holen(verweis.href, true);
        });

        window.addEventListener('popstate', function () {
            holen(window.location.href, false);
        });
    }

    function start() {
        document.querySelectorAll('form[data-reference-filter="form"]').forEach(einrichten);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', start);
    } else {
        start();
    }
})();
