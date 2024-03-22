# Dungeon Viewer
*DIY alternative to virtual tabletop RPG mapping*<br><br>
## Planned Features
| User Accounts | Character Sheets | 3D Character Modeler | Campaign Mapping |
| :- | :- | :- | :- |
| Updating/deleting accounts | 5E compatible character creation | Models for all default 5E | Default landscapes/interiors |
| Password reset emails | Avatar photo upload | Background/prop customization | NPC and PC movement |
| Campaign hosting & organizing | Custom weapons & items | Screenshot export | Prop placement |

## Progress
<details>
<summary>Week 1 (02-27-24 to 03-02-24)</summary>
 
* Established PHP routing and basic error handling
* Initial CSS setup
* Created reuseable header & footer elements
* Preliminary signup, signin, and signout pages & backend completed
  * Salt & hash user passwords
  * Sanitize user input against HTML & SQL sensitive characters
</details>


<details>
<summary>Week 2 (03-03-24 to 03-09-24)</summary>
 
* Created pages for users to update account info
* Started character sheet creation form
* Website licensing info, privacy policy, and about page
  * CC-BY-4.0 license of D&D 5E content & WotC Fan Content Policy
</details>


<details>
<summary>Week 3 (03-10-24 to 03-16-24)</summary>
 
* Finished character sheet creation form and database connection
* Dynamically display character sheet info and avatar on main character list page
* Set up threeJS via unpkg.com CDN
</details>


<details>
<summary>Week 4 (03-17-24 to 03-23-24)</summary>
 
* Created sample character, castle, house, and tree GLB files for character modeler
* Created lil-gui interface for changing scene elements in character modeler
* Added character stat editing and touched up character list styling
* Testing file upload for character avatars
* Set up MVC files for campaigns
</details>
