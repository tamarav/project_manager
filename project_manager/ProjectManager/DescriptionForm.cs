using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ProjectManager
{
    public partial class DescriptionForm : Form
    {
        private string korisnicko_ime, lozinka;
        private Dictionary<string, string> activity;
        public DescriptionForm(Dictionary<string, string> activity, string korisnicko_ime, string lozinka)
        {
            InitializeComponent();
            this.activity = activity;
            this.korisnicko_ime = korisnicko_ime;
            this.lozinka = lozinka;
            popuniPodatke();
        }

        private void popuniPodatke()
        {

            if (activity.ContainsKey("id"))
            {
                string value = "";

                if (activity.ContainsKey("ime_ucesnika"))
                {
                    value = activity["ime_ucesnika"];
                }
                else
                {
                    value = "";
                }
                lb_info.Text = "Naziv ucesnika:\t " + value + "\n";

                if (activity.ContainsKey("zadatak_id"))
                {
                    int v = Int32.Parse(activity["zadatak_id"]);
                    value = SOAP.SOAP.getTaskName(korisnicko_ime, lozinka, v);

                }
                else
                {
                    value = "";
                }
                lb_info.Text += "\nNaziv zadatka:\t " + value + "\n";
                if (activity.ContainsKey("ime_projekta"))
                {
                    value = activity["ime_projekta"];
                }
                else
                {
                    value = "";
                }
                lb_info.Text += "\nNaziv projekta:\t " + value + "\n";
                if (activity.ContainsKey("opis"))
                {
                    value = activity["opis"];
                }
                else
                {
                    value = "";
                }
                lb_info.Text += "\nOpis aktivnosti:\t " + value + "\n";
                if (activity.ContainsKey("potroseno_vremena"))
                {
                    value = activity["potroseno_vremena"];
                }
                else
                {
                    value = "";
                }
                lb_info.Text += "\nPotroseno vremena:\t " + value + "\n";
                if (activity.ContainsKey("postoji"))
                {
                    value = activity["postoji"];
                    if (value == "1")
                    {
                        value = "DA";
                    }
                    else
                    {
                        value = "NE";
                    }
                }
                else
                {
                    value = "";
                }
                lb_info.Text += "\nPosotji:\t " + value + "\n";
                if (activity.ContainsKey("datum"))
                {
                    value = activity["datum"];
                }
                else
                {
                    value = "";
                }
                lb_info.Text += "\nDatum:\t " + value;
            }
        }

    }
}
