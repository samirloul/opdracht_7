# Testplan - BE-opdracht 07

## Scope
- Feature1: Wijzigen voertuiggegevens
- Scenario_01 t/m Scenario_04
- Overzicht allergenen met pagination (4 records)

## Testomgeving
- Framework: Laravel
- Taal: PHP 8+
- DB: MySQL/SQLite
- Browser: Chrome

## Testgevallen
1. Scenario_01 voertuiggegevens wijzigen
- Stap: wijzig Vespa naar Vespa Piaggio, brandstof Elektrisch, kenteken DRS-52-E
- Verwacht: redirect naar voertuigen van Mohammed, data zichtbaar aangepast

2. Scenario_02 voertuig aan andere instructeur toewijzen
- Stap: wijzig instructeur van Vespa naar Bert van Sali
- Verwacht: Vespa niet meer in lijst Mohammed

3. Scenario_03 beschikbaar voertuig wijzigen en toewijzen
- Stap: open Kymco vanuit beschikbare voertuigen, wijzig brandstof Elektrisch, klik Wijzig
- Verwacht: Kymco staat nu in lijst van Mohammed met nieuwe brandstof

4. Scenario_04 unhappy path DAF bouwjaar readonly
- Stap: open DAF, probeer bouwjaar te wijzigen
- Verwacht: veld readonly en opgeslagen bouwjaar blijft ongewijzigd

5. Overzicht allergenen pagination
- Stap: open allergenenoverzicht en navigeer pagina 1 -> 2
- Verwacht: max 4 records per pagina en rustige overgang

## Unit tests
- test_normalize_kenteken_uses_trim_and_uppercase
- test_is_bouwjaar_readonly_returns_true_for_daf
