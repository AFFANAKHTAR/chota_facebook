#chota_facebook #basic social_networking_site functionalities  
login/signup/image_crud/friend_request_system/like&comment_system

--image crud ka gyaan
#for creating or adding product
. make function for upload images and save data to database
#then for reading data,
. feth data from database and show it on index.php and give button to delete and update page with link
#then for delete data, 
. make image remove function with unlink functionlity,call it it and then also delete form database after that.
#then for update,
. show form to user with already exist values in database and access their new values through post,and change new with old values in database
. after checking for image file exist or not,if exist at tmp location,delete old image saved at database using image remove function, and
. update new image at that location using image upload function.
. and update database too with new image location

--logic for friend request system
frontend part--
if send req is clicked 
    send request to server
    change button value to cancel req

if cancel req is clicked 
    send req to server
    change to send req

if already friends
    change button to unfriend
        if unfriend clicked
            talks to server and send request


PHP & MYSQLI
    MYSQLI DATABASE TABLE >>> FRIEND_REQUEST
    ID SENDER RECIEVER


LOGIC--

when send req is clicked {
    insert in table friend_request the value 
    senderID- $userID of the current userID
    recieverID- $USERID of the friend page (fetch it from database)
    flag -0 
    `0` means not accepted yet 
    `1` accepted 
    time-now()
}

when cancel req is clicked{
    delete `that row` from table
    change value to send request
}


93--paul(reciever) 

when logged in{
    select from friend_request table 
        friend_request
            he should be recieverID and flag should be 0
                notify(or show)

                fetch senderID from friend_request table 
                    and based on that fetch sender details from user table and show it
                        give button to accept or reject

                if accept is clicked 
                    update table friend_request making flag=1
                            OR
                    insert values in friends table(user_one,user_two),here user_one is person itself,and user2 is a friend
                if decline is clicked
                    delete that row from table friend_request

}

    receivers profile 
        check if friend - flag should be 1
                OR
        if you have separate friends table just show that
                change button to unfriend
                    if clicked 
                        delete row


