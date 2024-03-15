# Gestiune-comenzi-catre-furnizori-de-marfa-la-supermarket

Proiectul are ca scop crearea unei baze de date, folosind limbajul MySQL, si dezvoltarea unei aplicații de gestionare a comenzilor către furnizori pentru un supermarket. Această aplicație este reprezentă de un server local php care se conectează la baza de date.

# Structura bazei de date
## Tabele
### Furnizori
-	FurnizorID: INT
-	Nume: NVARCHAR
-	Adresa: NVARCHAR
-	Telefon: NVARCHAR
-	Email: NVARCHAR
### CategoriiProduse
-	CategorieID: INT
-	NumeCategorie: NVARCHAR
-	Descriere: NVARCHAR
### Produse
-	ProdusID: INT
-	NumeProdus: NVARCHAR
-	Pret: MONEY
-	CategorieID: INT
-	FurnizorID: INT
### Comenzi
-	ComandaID: INT
-	DataComanda: DATE
-	FurnizorID: INT
### Stocuri
-	StocID: INT
-	ProdusID: INT
-	Cantitate: DECIMAL
### DetaliiComenzi (tabel de legatură)
-	ComandaID: INT
-	ProdusID: INT
-	Cantitate: DECIMAL
-	PretUnitar: MONEY
### Administrator
-	AdministratorID: INT
-	NumeUtilizator: NVARCHAR
-	Parola: NVARCHAR

## Relații
-	Furnizori -> Produse: Relație 1:N (Un furnizor poate furniza mai multe produse, dar un produs aparține unui singur furnizor).
-	CategoriiProduse -> Produse: Relație 1:N (O categorie poate avea mai multe produse, dar un produs aparține unei singure categorii).
-	Produse -> Stocuri: Relație 1:N (Un produs poate avea mai multe înregistrări de stocuri, dar o înregistrare de stoc aparține unui singur produs).
-	Produse -> Comenzi: Relație N:N (Un produs poate fi inclus în mai multe comenzi, iar o comandă poate conține mai multe produse).
-	Furnizori -> Comenzi: Relatie 1:N(Un furnizor poate avea mai multe comenzi, dar o comanda poate fi data catre un singur furnizor).

## Constrângeri de Integritate
### Tabela Furnizori:
-	Cheie primară: FurnizorID
-	Nume: trebuie să fie unic 
### Tabela CategoriiProduse:
-	Cheie primară: CategorieID
-	NumeCategorie: trebuie să fie unic
### Tabela Produse:
-	Cheie primară: ProdusID
-	Cheie externă către Furnizori: FurnizorID
-	Cheie externă către CategoriiProduse: CategorieID
-	NumeProdus: trebuie să fie unic
-	Pret: nu poate fi nul
### Tabela Comenzi:
-	Cheie primară: ComandaID
-	Cheie externă către Furnizori: FurnizorID
-	DataComanda: trebuie să fie validă
### Tabela Stocuri:
-	Cheie primară: StocID
-	Cheie externă către Produse: ProdusID
-	Cantitate: nu poate fi negativa
### Tabela DetaliiComenzi:
-	Cheie primară compusă: ComandaID + ProdusID
-	Cheie externă către Comenzi: ComandaID
-	Cheie externă către Produse: ProdusID
-	Cantitate și PretUnitar: nu pot fi negative
### Tabela Administrator:
-	Cheie primară: AdministratorID
