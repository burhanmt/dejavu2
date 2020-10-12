<?php

/**
 * I did the roles as much as simple in the platform. Therefore, The roles didn't store
 * in the database.
 *
 * Basic explanation of the roles:
 * -------------------------------
 *  0: It represents Dejavu standalone users who comes from Dejavu official website by subscribing to the platform.
 *  1: It represents Partner of the Dejavu such as a school or a language center. But the role level is moderator
 *     level. It means, limited to see all partner's customers. Just Imagine. There is a school and its classrooms.
 *     A user which has "partner-moderator" role, can see Class-A only.
 *  2: A user which has "partner-admin" role, can see all classrooms.
 *  3: It represents Dejavu administrator as "platform-editor". He can edit Dejavu vocabularies and articles.
 *     Also he can add new articles, he can create a new category. But he can't delete a record or
 *     can't access Dejavu users' information.
 *  4: It represents Dejavu administrator as "platform-moderator". He has all access of number 3. Plus, he can access
 *     Dejavu users' information and he can change them.
 *  5: It represents Dejavu administrator as "platform-admin". He can do everything except to delete a record.
 *  6: It represents Dejavu administrator as "platform-master". He is the owner of the platform. He can do everything,
 *     including to delete any record or a user which is connected to Dejavu user or Dejavu administrator.
 *
 *    All those rules were defined by Burhan. (26 Sept. 2020 Saturday, 23:33 - Glasgow City, UK.
 */
return [
    'customer' => 0,
    'partner-moderator' => 1,
    'partner-admin' => 2,
    'platform-editor' => 3,
    'platform-moderator' => 4,
    'platform-admin' => 5,
    'platform-master' => 6
];
