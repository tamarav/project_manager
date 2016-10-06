using System;
using System.Collections;
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
    public partial class ProjectsForm : Form
    {
        public User user = null;
        private string korisnicko_ime, lozinka;
        private ArrayList allActivities = null;

        public ProjectsForm(string username, string password)
        {
            InitializeComponent();
            user = new User(username, password);
            this.korisnicko_ime = username;
            this.lozinka = password;
            if (this.user.Role == "nadzor" || this.user.Role == "sef projekta")
            {
                this.btn_add.Enabled = false;
                this.btn_edit.Enabled = false;
            }
        }

        private void treeView1_AfterSelect(object sender, TreeViewEventArgs e)
        {
            switch (this.tv_list.SelectedNode.Text)
            {
                case "Aktivnosti":
                    ArrayList activities = SOAP.SOAP.getActivities(user.Korisniko_ime, user.Lozinka);
                    this.setTable(activities);
                    break;
            }
        }

        private void setTable(ArrayList activities) 
        {
            this.allActivities = activities;
            this.lv_info.Items.Clear();

            ListViewItem lvi;

            foreach (Dictionary<string, string> activity in activities)
            {


                if (activity.ContainsKey("id"))
                {
                    string value = activity["id"];
                    lvi = new ListViewItem(value);
                    

                    if (activity.ContainsKey("ime_ucesnika"))
                    {
                        value = activity["ime_ucesnika"];
                    }
                    else
                    {
                        value = "";
                    }
                    lvi.SubItems.Add(value);
                    
                    if (activity.ContainsKey("zadatak_id"))
                    {   
                        int v = Int32.Parse(activity["zadatak_id"]);
                        value = SOAP.SOAP.getTaskName(korisnicko_ime, lozinka, v);
                           
                    }
                    else
                    {
                        value = "";
                    }
                    lvi.SubItems.Add(value + "( " + activity["ime_projekta"] + " )");
                    if (activity.ContainsKey("ime_projekta"))
                    {
                        value = activity["ime_projekta"];
                    }
                    else
                    {
                        value = "";
                    }
                    lvi.SubItems.Add(value);
                    if (activity.ContainsKey("opis"))
                    {
                        value = activity["opis"];
                    }
                    else
                    {
                        value = "";
                    }
                    lvi.SubItems.Add(value);
                    if (activity.ContainsKey("potroseno_vremena"))
                    {
                        value = activity["potroseno_vremena"];
                    }
                    else
                    {
                        value = "";
                    }
                    lvi.SubItems.Add(value);
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
                    lvi.SubItems.Add(value);
                    if (activity.ContainsKey("datum"))
                    {
                        value = activity["datum"];
                    }
                    else
                    {
                        value = "";
                    }
                    lvi.SubItems.Add(value);
                    this.lv_info.Items.Add(lvi);
                }
            }
        }

        private void btn_add_Click(object sender, EventArgs e)
        {
            AddEditForm form = new AddEditForm(user.Korisniko_ime, user.Lozinka);
            form.ShowDialog();
        }

        private void ProjectsForm_FormClosing(object sender, FormClosingEventArgs e)
        {
            Application.Exit();
        }

        private void btn_refresh_Click(object sender, EventArgs e)
        {
            switch (this.tv_list.SelectedNode.Text)
            {
                case "Aktivnosti":
                    ArrayList activities = SOAP.SOAP.getActivities(user.Korisniko_ime, user.Lozinka);
                    this.setTable(activities);
                    break;
            }
        }

        private void btn_edit_Click(object sender, EventArgs e)
        {
            int id = Int32.Parse(this.lv_info.SelectedItems[0].SubItems[0].Text);

            foreach (Dictionary<string, string> p in this.allActivities)
            {
                if (p.ContainsKey("id"))
                {

                    if (id == Int32.Parse(p["id"]))
                    {
                        AddEditForm form = new AddEditForm(korisnicko_ime, lozinka, p);
                        form.ShowDialog();
                        break;
                    }
                }
            }

        }

        private void logOutToolStripMenuItem_Click(object sender, EventArgs e)
        {
            Form1 form = new Form1();
                form.Show();
                this.Hide();
        }

        private void ProjectsForm_Load(object sender, EventArgs e)
        {
        }

        private void btn_show_Click(object sender, EventArgs e)
        {

            int id = Int32.Parse(this.lv_info.SelectedItems[0].SubItems[0].Text);

            foreach (Dictionary<string, string> p in this.allActivities)
            {
                if (p.ContainsKey("id"))
                {

                    if (id == Int32.Parse(p["id"]))
                    {
                        DescriptionForm form = new DescriptionForm(p, korisnicko_ime, lozinka);
                        form.ShowDialog();
                        break;
                    }
                }
            }

        }

        private void aboutToolStripMenuItem_Click(object sender, EventArgs e)
        {
            AboutForm form = new AboutForm();
            form.ShowDialog();
        }

        private void btn_delete_Click(object sender, EventArgs e)
        {
            int id = Int32.Parse(this.lv_info.SelectedItems[0].SubItems[0].Text);
            bool success = SOAP.SOAP.deleteActivity(korisnicko_ime, lozinka, id);
        }
    }
}
