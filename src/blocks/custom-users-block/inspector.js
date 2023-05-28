const {InspectorControls} = wp.blockEditor;
import {TabPanel} from "@wordpress/components";
import ContentControl from "./controller/ContentControl";
import AvatarSettings from "./controller/AvatarSettings";
import UserNameSettings from "./controller/UserNameSettings";
import UserBioSettings from "./controller/UserBioSettings";
import UserDesignationSettings from "./controller/UserDesignationSettings";
import SocialShareSettings from "./controller/SocialShareSettings";
import CardSettings from "./controller/CardSettings";
import TabTitle from "../../components/TabTitle";

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


    return (
        <InspectorControls key="controls">
            <div className="gtusers-panel-control-wrapper">
                <TabPanel className="gtusers-tab-panel" activeClass="active-tab" tabs={[
                    {
                        name: "content",
                        title: <TabTitle title={`Content`} icon={`dashicons-edit`}/>,
                        className: "gtusers-tab-btn content",
                    },
                    {
                        name: "styles",
                        title: <TabTitle title={`Settings / Styles`} icon={`dashicons-admin-generic`}/>,
                        className: "gtusers-tab-btn settings",
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
                                    {name_visibility && <UserNameSettings data={props}/>}
                                    {email_visibility && <UserDesignationSettings data={props}/>}
                                    {bio_visibility && <UserBioSettings data={props}/>}
                                    {social_visibility && <SocialShareSettings data={props}/>}
                                    <CardSettings data={props}/>
                                </>
                            )}
                        </div>
                    )}
                </TabPanel>
            </div>
        </InspectorControls>
    )
}

export default Inspector;