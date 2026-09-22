/*
 * Filterleiste der Referenzliste.
 *
 * Ohne dieses Skript ist das Formular ein gewoehnliches GET-Formular: auswaehlen,
 * "Suchen" druecken, Seite neu laden. Mit dem Skript loest schon die Auswahl
 * selbst aus, und nachgeladen wird nur der Ergebnisbereich unter der Leiste -
 * der Fokus bleibt damit im gerade bedienten Auswahlfeld, und die Seite springt
 * nicht an den Anfang.
 *
 * Geholt wird ueber einen eigenen Ausgabetyp, der allein das Listen-Element
 * rendert. Das sind ein paar Kilobyte statt der ganzen Seite mit Kopf, Menue und
 * Fuss.
 *
 * Der Filterstand steht hinter dem Doppelkreuz:
 *
 *     /referenzen#kategorien=10,19&seite=2
 *
 * Damit laesst sich eine Auswahl verschicken und als Lesezeichen ablegen, und
 * Zurueck und Vor kommen von selbst - jede Aenderung am Adresszusatz ist ein
 * eigener Schritt im Verlauf. Wer eine solche Adresse ohne JavaScript oeffnet,
 * sieht die ungefilterte Liste; der Adresszusatz erreicht den Server nun einmal
 * nicht.
 *
 * Geht das Nachladen schief, uebernimmt ein gewoehnlicher Seitenwechsel mit
 * Abfrageparametern - lieber ein Neuladen als eine Liste, die nicht zur Auswahl
 * passt.
 */
(function () {
    'use strict';

    var LAUFEND = 'reference__results--busy';
    var SCHLUESSEL_KATEGORIEN = 'kategorien';
    var SCHLUESSEL_SEITE = 'seite';

    var lichtkasten = null;

    /**
     * Die Geraetevorschauen oeffnen sich in GLightbox. Das Sitepaket bindet die
     * Bibliothek einmal beim Laden an die damals vorhandenen Verweise - nach dem
     * Austausch der Liste sind das nicht mehr dieselben. Ohne das hier springt
     * ein Klick nur an den Anker, und der Anker wiederum raeumt den Filterstand
     * aus dem Adresszusatz.
     */
    function lichtkastenNeuBinden() {
        if (typeof GLightbox !== 'function') {
            return;
        }
        var einstellungen = {};
        var block = document.getElementById('t3b-lightbox-config');
        if (block) {
            try {
                einstellungen = JSON.parse(block.textContent || '{}');
            } catch (e) {
                // Kaputte Einstellungen sind kein Grund, die Vorschau ganz
                // aufzugeben - dann eben mit den Vorgaben.
            }
        }
        if (lichtkasten && typeof lichtkasten.destroy === 'function') {
            lichtkasten.destroy();
        }
        lichtkasten = GLightbox(einstellungen);
    }

    function einrichten(formular) {
        if (formular.dataset.referenceFilterBereit) {
            return;
        }
        formular.dataset.referenceFilterBereit = '1';

        var ergebnisse = document.getElementById(formular.dataset.referenceResults);
        if (!ergebnisse) {
            return;
        }

        var ausgabetyp = formular.dataset.referenceType;
        var elementUid = formular.dataset.referenceCe;
        var laufend = null;

        // Der Knopf bleibt im Markup, damit er ohne JavaScript da ist; hier
        // uebernimmt die Auswahl selbst.
        var knopf = formular.querySelector('[data-reference-submit]');
        if (knopf) {
            knopf.hidden = true;
        }

        function felder() {
            return Array.prototype.slice.call(formular.querySelectorAll('select[name*="[categories]"]'));
        }

        /** Zu welcher Gruppe gehoert ein Auswahlfeld (die Zahl im Feldnamen). */
        function gruppeVon(feld) {
            var treffer = feld.name.match(/\[categories\]\[(\d+)\]/);
            return treffer ? treffer[1] : null;
        }

        // --- Stand: {kategorien: ['10','19'], seite: 2} ----------------------

        function standAusFeldern() {
            var gewaehlt = [];
            felder().forEach(function (feld) {
                if (feld.value) {
                    gewaehlt.push(feld.value);
                }
            });
            return { kategorien: gewaehlt, seite: 1 };
        }

        function standAusHash() {
            var roh = window.location.hash.replace(/^#/, '');
            if (!roh) {
                return null;
            }
            var teile = new URLSearchParams(roh);
            if (!teile.has(SCHLUESSEL_KATEGORIEN) && !teile.has(SCHLUESSEL_SEITE)) {
                return null;
            }
            var kategorien = (teile.get(SCHLUESSEL_KATEGORIEN) || '')
                .split(',')
                .map(function (w) { return w.trim(); })
                .filter(function (w) { return /^\d+$/.test(w); });
            return { kategorien: kategorien, seite: parseInt(teile.get(SCHLUESSEL_SEITE), 10) || 1 };
        }

        function alsHash(stand) {
            var teile = [];
            if (stand.kategorien.length) {
                teile.push(SCHLUESSEL_KATEGORIEN + '=' + stand.kategorien.join(','));
            }
            if (stand.seite > 1) {
                teile.push(SCHLUESSEL_SEITE + '=' + stand.seite);
            }
            return teile.length ? '#' + teile.join('&') : '';
        }

        /** Setzt die Auswahlfelder auf den Stand; unbekannte Werte fallen weg. */
        function feldernZuweisen(stand) {
            var uebrig = stand.kategorien.slice();
            felder().forEach(function (feld) {
                var passend = uebrig.find(function (uid) {
                    return feld.querySelector('option[value="' + uid + '"]');
                });
                feld.value = passend || '';
                if (passend) {
                    uebrig.splice(uebrig.indexOf(passend), 1);
                }
            });
        }

        /** Adresse des Ausschnitts zum aktuellen Stand der Felder. */
        function ausschnittAdresse(stand) {
            var adresse = new URL(window.location.pathname, window.location.href);
            adresse.searchParams.set('type', ausgabetyp);
            adresse.searchParams.set('tx_references_ce', elementUid);
            felder().forEach(function (feld) {
                if (feld.value) {
                    adresse.searchParams.set('tx_references_list[categories][' + gruppeVon(feld) + ']', feld.value);
                }
            });
            var land = formular.querySelector('select[name$="[country]"]');
            if (land && land.value) {
                adresse.searchParams.set('tx_references_list[country]', land.value);
            }
            if (stand.seite > 1) {
                adresse.searchParams.set('tx_references_list[currentPage]', stand.seite);
            }
            return adresse.toString();
        }

        /** Dieselbe Auswahl als gewoehnliche Seitenadresse - fuer den Rueckfall. */
        function seitenAdresse(stand) {
            var adresse = new URL(ausschnittAdresse(stand));
            adresse.searchParams.delete('type');
            adresse.searchParams.delete('tx_references_ce');
            return adresse.toString();
        }

        // --- Nachladen -------------------------------------------------------

        function laden(stand) {
            if (laufend) {
                laufend.abort();
            }
            var dieser = new AbortController();
            laufend = dieser;
            ergebnisse.classList.add(LAUFEND);
            ergebnisse.setAttribute('aria-busy', 'true');

            fetch(ausschnittAdresse(stand), {
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
                    lichtkastenNeuBinden();
                })
                .catch(function (fehler) {
                    if (fehler.name === 'AbortError') {
                        return;
                    }
                    window.location.href = seitenAdresse(stand);
                })
                .then(function () {
                    // Nur aufraeumen, wenn inzwischen keine neuere Anfrage
                    // laeuft - sonst nimmt die abgebrochene der nachfolgenden
                    // ihren Ladezustand weg.
                    if (laufend === dieser) {
                        ergebnisse.classList.remove(LAUFEND);
                        ergebnisse.removeAttribute('aria-busy');
                        laufend = null;
                    }
                });
        }

        /** Adresszusatz setzen; das loest hashchange und damit das Laden aus. */
        function standSetzen(stand) {
            var neuerHash = alsHash(stand);
            if (neuerHash === window.location.hash || (neuerHash === '' && window.location.hash === '')) {
                laden(stand);
                return;
            }
            if (neuerHash === '') {
                // Ein leerer Adresszusatz laesst sich nicht ueber location.hash
                // setzen, ohne ein einzelnes Doppelkreuz stehen zu lassen.
                window.history.pushState({}, '', window.location.pathname + window.location.search);
                laden(stand);
                return;
            }
            window.location.hash = neuerHash;
        }

        // --- Ereignisse ------------------------------------------------------

        formular.addEventListener('change', function (ereignis) {
            if (ereignis.target.tagName === 'SELECT') {
                standSetzen(standAusFeldern());
            }
        });

        formular.addEventListener('submit', function (ereignis) {
            ereignis.preventDefault();
            standSetzen(standAusFeldern());
        });

        // Blaettern und die Filter-Chips tragen echte Adressen, damit sie ohne
        // JavaScript funktionieren. Hier lesen wir ihre Argumente aus und
        // schreiben daraus den Adresszusatz.
        ergebnisse.addEventListener('click', function (ereignis) {
            var verweis = ereignis.target.closest('a.reference__pagination-link, a.reference__filter-chip');
            if (!verweis || ereignis.metaKey || ereignis.ctrlKey || ereignis.shiftKey || ereignis.button !== 0) {
                return;
            }
            ereignis.preventDefault();

            var argumente = new URL(verweis.href, window.location.href).searchParams;
            var kategorien = [];
            argumente.forEach(function (wert, name) {
                if (/^tx_references_list\[categories\]\[\d+\]$/.test(name) && wert) {
                    kategorien.push(wert);
                }
            });
            var stand = {
                kategorien: kategorien,
                seite: parseInt(argumente.get('tx_references_list[currentPage]'), 10) || 1
            };
            feldernZuweisen(stand);
            standSetzen(stand);
        });

        window.addEventListener('hashchange', function () {
            var stand = standAusHash();
            if (!stand) {
                // Ein Adresszusatz, der keiner von uns ist - etwa der Anker
                // einer Geraetevorschau. Nur ein leerer bedeutet "Filter weg";
                // ein fremder darf die Liste nicht anruehren.
                if (window.location.hash !== '') {
                    return;
                }
                stand = { kategorien: [], seite: 1 };
            }
            feldernZuweisen(stand);
            laden(stand);
        });

        // --- Beim Laden ------------------------------------------------------

        var ausHash = standAusHash();
        if (ausHash) {
            // Geteilte Adresse: der Server kennt den Adresszusatz nicht, also
            // holen wir die passende Liste nach.
            feldernZuweisen(ausHash);
            laden(ausHash);
        } else if (felder().some(function (feld) { return feld.value; })) {
            // Ohne JavaScript abgeschickt oder altes Lesezeichen: der Server hat
            // schon richtig gerendert. Wir schreiben die Auswahl nur in den
            // Adresszusatz, damit ab hier ein Stand gilt statt zwei.
            var stand = standAusFeldern();
            window.history.replaceState({}, '', window.location.pathname + alsHash(stand));
        }
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
