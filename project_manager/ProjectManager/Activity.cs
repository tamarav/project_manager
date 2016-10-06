using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ProjectManager
{
    public class Activity
    {
        private int id, ucesnik_id, potroseno_vrijeme, postoji;

        public int Postoji
        {
            get { return postoji; }
            set { postoji = value; }
        }

        public int Potroseno_vrijeme
        {
            get { return potroseno_vrijeme; }
            set { potroseno_vrijeme = value; }
        }

        public int Ucesnik_id
        {
            get { return ucesnik_id; }
            set { ucesnik_id = value; }
        }

        public int Id
        {
            get { return id; }
            set { id = value; }
        }
        private string naziv, ucesnik, opis, zadatak, datum;

        public string Datum
        {
            get { return datum; }
            set { datum = value; }
        }

        public string Zadatak
        {
            get { return zadatak; }
            set { zadatak = value; }
        }

        public string Opis
        {
            get { return opis; }
            set { opis = value; }
        }

        public string Ucesnik
        {
            get { return ucesnik; }
            set { ucesnik = value; }
        }

        public string Naziv
        {
            get { return naziv; }
            set { naziv = value; }
        } 
    }
}
