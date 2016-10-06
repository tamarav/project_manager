using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ProjectManager
{
    public class User
    {
        private static string korisniko_ime = "";

        public string Korisniko_ime
        {
            get { return User.korisniko_ime; }
            set { User.korisniko_ime = value; }
        }
        private static string lozinka = "";

        public string Lozinka
        {
            get { return User.lozinka; }
            set { User.lozinka = value; }
        }
        private static int id = 0;

        private string ime = "";

        public string Ime
        {
            get { return ime; }
            set { ime = value; }
        }
        private string prezime = "";

        public string Prezime
        {
            get { return prezime; }
            set { prezime = value; }
        }
        private string role = "";

        public string Role
        {
            get { return role; }
            set { role = value; }
        }

        public User(string korisnicko_ime, string lozinka)
        {
            this.Korisniko_ime = korisnicko_ime;
            this.Lozinka = lozinka;
            Dictionary<string, string> u = SOAP.SOAP.getUser(korisnicko_ime, lozinka, User.id);

            if (u.ContainsKey("ime"))
            {
                this.ime = u["ime"];
            }
            if (u.ContainsKey("prezime"))
            {
                this.prezime = u["prezime"];
            }
            if (u.ContainsKey("vrsta_ucesnika"))
            {
                this.role = u["vrsta_ucesnika"];
            }
           
        }

        public static int getId()
        {
            return id;
        }

        public static void setId(int id)
        {
            User.id = id;
        }
    }
}
