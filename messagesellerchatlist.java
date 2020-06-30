package com.pamsillah.biddingwars.InnerActivities;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.firebase.client.ChildEventListener;
import com.firebase.client.DataSnapshot;
import com.firebase.client.Firebase;
import com.firebase.client.FirebaseError;
import com.firebase.client.ValueEventListener;
import com.pamsillah.biddingwars.Adapters.MessageSellerAdapter;
import com.pamsillah.biddingwars.Config;
import com.pamsillah.biddingwars.Models.ChatListObject;
import com.pamsillah.biddingwars.Models.MessageObject;
import com.pamsillah.biddingwars.R;

import java.text.DateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

import static com.pamsillah.biddingwars.Config.IMG_URL;
import static com.pamsillah.biddingwars.Config.SHARED_PREF_NAME;

/**
 * Created by Sir Allen on 8/26/2017.
 */

public class MessageSellerchatlist extends AppCompatActivity {
    ImageView send;
    EditText message;
    Firebase rootRef, mRef, chatlistref, statusRef ;
    String textMessage;
    String receiver;
    String timeposted;
    String imgURL;
    String sender;
    MessageObject mobj;
    RecyclerView msg_recycler;
    List<MessageObject> msglist  = new ArrayList<MessageObject>();
    String fbid, propic;
    SharedPreferences fetchPrefs;
    Toolbar toolbar;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_message_seller);

        send    = (ImageView) findViewById(R.id.btn_send_msg);
        message = (EditText)findViewById(R.id.txt_msg) ;
        toolbar = (Toolbar)findViewById(R.id.toolbar);
        msg_recycler = (RecyclerView) findViewById(R.id.msg_rv);
        msg_recycler.setHasFixedSize(true);
        msg_recycler.setLayoutManager(new LinearLayoutManager(this ));

        Intent res = getIntent();
        fbid   = res.getExtras().getString("FBID");
        rootRef = new Firebase("https://bidding-wars-28e79.firebaseio.com/messages/");
        chatlistref = new Firebase("https://bidding-wars-28e79.firebaseio.com/chatlist/"+fbid);
        String recStr[] = fbid.split("_");
        receiver= recStr[1];
//        String senderStr[] = fbid.split("_");
//        sender = senderStr[0];

        toolbar.setTitle(receiver);
        setSupportActionBar(toolbar);
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        fetchPrefs = getSharedPreferences(SHARED_PREF_NAME, MODE_PRIVATE);
        sender  = fetchPrefs.getString(Config.EMAIL_SHARED_PREF, null);
        propic  = fetchPrefs.getString(IMG_URL, "");

        mobj = new MessageObject();
        timeposted = DateFormat.getDateTimeInstance().format(new Date());


        mRef = new Firebase("https://bidding-wars-28e79.firebaseio.com/messages/" +fbid);
        statusRef = new Firebase("https://bidding-wars-28e79.firebaseio.com/status/" + receiver);
        Log.d("refure", statusRef.toString());

        readData();
        getOnlineStatus();

        send.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                textMessage = message.getText().toString().trim();
                mobj.setReceiver(receiver);
                mobj.setUsername(sender);
                mobj.setMessagesent(textMessage);
                mobj.setTimesent(timeposted);
                mobj.setpicurl("url");
                mRef.push().setValue(mobj);
                message.setText("");
                Toast.makeText(MessageSellerchatlist.this, sender, Toast.LENGTH_SHORT).show();

                chatList();

            }
        });


    }

    private void getOnlineStatus() {
        statusRef.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                String status = dataSnapshot.getValue(String.class);
                Log.d("sitetasi", receiver);
            }

            @Override
            public void onCancelled(FirebaseError firebaseError) {

            }
        });
    }


    private void chatList() {
        ChatListObject cobj = new ChatListObject();
        cobj.setUsername(sender);
        cobj.setMessagesent(textMessage);
        cobj.setPicurl("url");
        cobj.setTimesent(timeposted);
        cobj.setReceiver(receiver);

        chatlistref.setValue(cobj);
    }


    public void readData() {
        mRef.addValueEventListener(new ValueEventListener() {
            @Override
            public void onDataChange(DataSnapshot dataSnapshot) {
                msglist.clear();

                for (DataSnapshot ds: dataSnapshot.getChildren()){
                    MessageObject msg = ds.getValue(MessageObject.class);
                    msglist.add(msg);
                }
                MessageSellerAdapter adapter = new MessageSellerAdapter(msglist, getApplicationContext());
                msg_recycler.setAdapter(adapter);
                adapter.notifyDataSetChanged();
            }

            @Override
            public void onCancelled(FirebaseError firebaseError) {

            }
        });

    }
}
