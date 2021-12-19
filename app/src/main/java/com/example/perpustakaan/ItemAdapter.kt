package com.example.perpustakaan

import android.content.Context
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.FragmentManager
import androidx.recyclerview.widget.RecyclerView
import com.squareup.picasso.Picasso
import kotlinx.android.synthetic.main.simple_list.view.*

class ItemAdapter(var context : Context, var list:ArrayList<item>) :
    RecyclerView.Adapter<RecyclerView.ViewHolder>() {
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): RecyclerView.ViewHolder {
        var v: View = LayoutInflater.from(context).inflate(R.layout.simple_list,parent,false)
        return ItemHolder(v)
    }

    override fun onBindViewHolder(holder: RecyclerView.ViewHolder, position: Int) {
        (holder as ItemHolder).bind(list[position].name,list[position].stok,list[position].photo)
    }

    override fun getItemCount(): Int {
        return list.size
    }
    class ItemHolder(itemView: View): RecyclerView.ViewHolder(itemView){
        fun bind(n:String,s:Int,g:String){
            itemView.nama_buku.text = "Judul = "+n
            itemView.stok_buku.text = "Stok Tersedia = "+s.toString()
            var web :String = "http://192.168.56.1/mini_projek/miniproject2/images/"
            web = web.replace(" ","%20")
            Picasso
                .get()
                .load(web+g)
                .placeholder(R.drawable.buuk)
                .error(R.drawable.buuk)
                .into(itemView.img_buku)
        }
    }
}