using System;
using System.Collections;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Text.RegularExpressions;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ProjectManager
{
    public partial class AddEditForm : Form
    {
        private class Item
        {
            public string Name;
            public int Value;
            public Item(string name, int value)
            {
                Name = name; Value = value;
            }
            public override string ToString()
            {
                return Name;
            }
        }
        private ArrayList ucesnici = new ArrayList();
        private ArrayList zadaci = new ArrayList();
        Dictionary<string, string> activity = null;
        private string korisnicko_ime, lozinka;
        public AddEditForm(string korisnicko_ime, string lozinka)
        {
            InitializeComponent();
            this.lbl_title.Text = "Dodaj Aktivnost";
            this.btn_add_edit.Text = "Dodaj";
            this.ucesnici = SOAP.SOAP.getRadnici(korisnicko_ime, lozinka);
            this.zadaci = SOAP.SOAP.getZadaci(korisnicko_ime, lozinka);
            this.korisnicko_ime = korisnicko_ime;
            this.lozinka = lozinka;
            foreach (Dictionary<string, string> p in this.ucesnici)
            {
                if (p.ContainsKey("ime") && p.ContainsKey("prezime") && p.ContainsKey("id"))
                {
                    string name = p["ime"] + " " + p["prezime"];
                    int id = Int32.Parse(p["id"]);
                    this.cb_ucesnik.Items.Add(new Item(name, id));
                }
            }

            foreach (Dictionary<string, string> p in this.zadaci)
            {
                if (p.ContainsKey("naziv") && p.ContainsKey("id"))
                {
                    string name = p["naziv"];
                    int id = Int32.Parse(p["id"]);
                    this.cb_zadatak.Items.Add(new Item(name, id));
                }
            }
        }

        public AddEditForm( string korisnicko_ime, string lozinka, Dictionary<string, string> activity)
        {
            InitializeComponent();
            this.lbl_title.Text = "Izmjeni Aktivnost";
            this.btn_add_edit.Text = "Sacuvaj";
            this.korisnicko_ime = korisnicko_ime;
            this.lozinka = lozinka;
            this.activity = activity;

            this.ucesnici = SOAP.SOAP.getRadnici(korisnicko_ime, lozinka);
            this.zadaci = SOAP.SOAP.getZadaci(korisnicko_ime, lozinka);

            foreach (Dictionary<string, string> p in this.ucesnici)
            {
                if (p.ContainsKey("ime") && p.ContainsKey("prezime") && p.ContainsKey("id"))
                {
                    string name = p["ime"] + " " + p["prezime"];
                    int id = Int32.Parse(p["id"]);
                    Item i = new Item(name, id);
                    this.cb_ucesnik.Items.Add(i);
                    if (id == Int32.Parse(activity["ucesnik_id"]))
                    {
                        this.cb_ucesnik.SelectedItem = i;
                    }
                }
            }

            foreach (Dictionary<string, string> p in this.zadaci)
            {
                if (p.ContainsKey("naziv") && p.ContainsKey("id"))
                {
                    string name = p["naziv"];
                    int id = Int32.Parse(p["id"]);

                    Item i = new Item(name, id);
                    this.cb_zadatak.Items.Add(i);
                    if (id == Int32.Parse(activity["zadatak_id"]))
                    {
                        this.cb_zadatak.SelectedItem = i;
                    }
                }
            }

            this.tb_opis.Text = activity["opis"];

            string datum = activity["datum"];
            string[] arr_datum = Regex.Split(datum, "-");

            int year = Int32.Parse(arr_datum[0]);
            int month = Int32.Parse(arr_datum[1]);
            int day = Int32.Parse(arr_datum[2]);
            this.dp_datum.Value = new DateTime(year, month, day);

            this.nud_potroseno_vremena.Value = Int32.Parse(activity["potroseno_vremena"]);

            this.cb_postoji.Checked = activity["postoji"] == "1" ? true : false;
        }

        private void btn_add_edit_Click(object sender, EventArgs e)
        {
            bool success = false;
            if (this.btn_add_edit.Text == "Dodaj")      
            {
                Item ucesnik_item = (Item)this.cb_ucesnik.SelectedItem;
                int ucesnik_id = ucesnik_item.Value;
                Item zadatak_item = (Item)this.cb_zadatak.SelectedItem;
                int zadatak_id = zadatak_item.Value;
                string opis = this.tb_opis.Text;
                string potroseno_vremena = this.nud_potroseno_vremena.Value.ToString();
                string datum = this.dp_datum.Value.ToShortDateString();
                int postoji = this.cb_postoji.Checked ? 1 : 0;
                success = SOAP.SOAP.saveActivity(korisnicko_ime, lozinka, 0, ucesnik_id, zadatak_id, opis, potroseno_vremena, datum, postoji);
            }
            else if (this.btn_add_edit.Text == "Sacuvaj")
            {
                Item ucesnik_item = (Item)this.cb_ucesnik.SelectedItem;
                int ucesnik_id = ucesnik_item.Value;
                Item zadatak_item = (Item)this.cb_zadatak.SelectedItem;
                int zadatak_id = zadatak_item.Value;
                string opis = this.tb_opis.Text;
                string potroseno_vremena = this.nud_potroseno_vremena.Value.ToString();
                string datum = this.dp_datum.Value.ToShortDateString();
                int postoji = this.cb_postoji.Checked ? 1 : 0;
                int id = Int32.Parse(this.activity["id"]);
                success = SOAP.SOAP.saveActivity(korisnicko_ime, lozinka, id, ucesnik_id, zadatak_id, opis, potroseno_vremena, datum, postoji);
            }
            if (success)
            {
                this.Close();
            }

        }

        private void btn_cancel_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void AddEditForm_Load(object sender, EventArgs e)
        {

        }
    }
}
