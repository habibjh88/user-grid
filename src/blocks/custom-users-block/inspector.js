const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import ContentControl from "./controller/ContentControl";
import AvatarSettings from "./controller/AvatarSettings";
import UserName from "./controller/UserName";
import UserBio from "./controller/UserBio";
import UserEmail from "./controller/UserEmail";
import SocialShare from "./controller/SocialShare";

function Inspector(props) {
    const {attributes, changeQuery, userData} = props;

    //All attribute
    const {
        avatar_visibility,
        name_visibility,
        email_visibility,
        bio_visibility,
        social_visibility
    } = attributes;


    return (<InspectorControls key="controls">
        <div className="gtusers-panel-control-wrapper">
            <TabPanel className="gtusers-tab-panel" activeClass="active-tab" tabs={[
                {
                    name: "content",
                    title: "Content",
                    className: "gtusers-tab-btn content"
                },
                {
                    name: "styles",
                    title: "Settings / Styles",
                    className: "gtusers-tab-btn settings"
                }
            ]}
            >
                {(tab) => (
                    <div className="gtusers-tab-content">

                        {/* Content Tab*/}
                        {tab.name === "content" && (
                            <>
                                <ContentControl data={props} changeQuery={changeQuery} userData={userData}/>
                            </>
                        )}

                        {/* Style Tab*/}
                        {tab.name === "styles" && (
                            <>
                                {avatar_visibility && <AvatarSettings data={props} changeQuery={changeQuery}/>}
                                {name_visibility && <UserName data={props}/>}
                                {email_visibility && <UserEmail data={props}/>}
                                {bio_visibility && <UserBio data={props}/>}
                                {social_visibility && <SocialShare data={props}/>}
                            </>
                        )}
                    </div>
                )}
            </TabPanel>
        </div>
    </InspectorControls>)
}

export default Inspector;