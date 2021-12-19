package com.example.perpustakaan

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.widget.Button
import android.widget.EditText
import android.widget.Toast
import com.android.volley.Request
import com.android.volley.RequestQueue
import com.android.volley.Response
import com.android.volley.toolbox.StringRequest
import com.android.volley.toolbox.Volley

class Regis : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_regis)
        val pwd : EditText = findViewById(R.id.pwd_su)
        val hp : EditText = findViewById(R.id.hp_su)
        val email: EditText =findViewById(R.id.email_su)
        val name : EditText = findViewById(R.id.username_su)
        val almt : EditText = findViewById(R.id.almt_su)
        val kota : EditText = findViewById(R.id.kota_su)
        val nim : EditText = findViewById(R.id.nim_su)
        val sign: Button =findViewById(R.id.daftar)
        sign.setOnClickListener {
                var url = "http://192.168.56.1/mini_projek/miniproject2/web_servis/daftar.php?nama="+name.text.toString()+"&email="+email.text.toString()+"&pwd="+pwd.text.toString()+"&hp="+hp.text.toString()+"&almt="+almt.text.toString()+"&kota="+kota.text.toString()+"&nim="+nim.text
                System.out.println(url)
                var rq : RequestQueue = Volley.newRequestQueue(this)
                var sr =  StringRequest(Request.Method.GET,url, Response.Listener { response ->
                    if(response.equals("0")){
                        Toast.makeText(this,"Akun sudah ada, mohon daftar kembali", Toast.LENGTH_LONG).show()
                    }
                    else{
                        Toast.makeText(this,"Akun berhasil ditambahkan", Toast.LENGTH_LONG).show()
                    }

                }, Response.ErrorListener { error ->
                    Toast.makeText(this,error.message, Toast.LENGTH_LONG).show()
                })
                rq.add(sr)
        }
    }

}